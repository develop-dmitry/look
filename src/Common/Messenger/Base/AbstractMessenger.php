<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Base;

use Look\Auth\Application\MessengerLogin\Contract\MessengerLoginInterface;
use Look\Auth\Application\MessengerLogin\DTO\MessengerLoginRequest;
use Look\Auth\Application\MessengerRegister\Contract\MessengerRegisterInterface;
use Look\Auth\Application\MessengerRegister\DTO\MessengerRegisterRequest;
use Look\Auth\Application\MessengerRegister\Exception\UserAlreadyExistsException;
use Look\Auth\Domain\User\Exception\UserWasNotCreateException;
use Look\Common\Dictionary\DictionaryInterface;
use Look\Common\Exception\InvalidValueException;
use Look\Common\Exception\UserDoesNotExistsException;
use Look\Common\Messenger\Base\Context\ContextInterface;
use Look\Common\Messenger\Base\Context\Exception\UserDoesNotAuthException;
use Look\Common\Messenger\Base\Exception\UserDoesNotSaveException;
use Look\Common\Messenger\Base\Handler\Enum\HandlerType;
use Look\Common\Messenger\Base\Handler\Exception\HandlerDoesNotExistsException;
use Look\Common\Messenger\Base\Handler\HandlerContainer\HandlerContainerInterface;
use Look\Common\Messenger\Base\Handler\HandlerInterface;
use Look\Common\Messenger\Base\User\Contract\UserInterface;
use Look\Common\Messenger\Base\User\Contract\UserRepositoryInterface;
use Look\Common\Messenger\Base\User\User;
use Look\Common\Messenger\Telegram\Value\TelegramToken;
use Look\Common\Value\Id\Id;
use Psr\Log\LoggerInterface;
use Throwable;

abstract class AbstractMessenger implements MessengerInterface
{
    // Init inside messenger callback
    protected ContextInterface $context;

    public function __construct(
        protected UserRepositoryInterface $userRepository,
        protected HandlerContainerInterface $handlers,
        protected MessengerLoginInterface $messengerLogin,
        protected MessengerRegisterInterface $messengerRegister,
        protected LoggerInterface $logger,
        protected DictionaryInterface $dictionary
    ) {
    }

    protected function executeHandler(HandlerInterface|callable $handler): mixed
    {
        $this->initContext();

        try {
            if (is_callable($handler)) {
                $handler = $handler();
            }

            $handler->execute($this->context, $this->visual);
        } catch (HandlerDoesNotExistsException) {
            $this->visual->setMessage($this->dictionary->getTranslate('messenger.unknown_handler'));
        } catch (Throwable $throwable) {
            $this->visual->setMessage($this->dictionary->getTranslate('messenger.network_error'));

            $this->logger->error('Unexpected error while execution message handler', [
                'exception' => $throwable->getMessage()
            ]);
        } finally {
            $this->saveUser();
        }

        return $this->makeResponse();
    }

    abstract protected function makeResponse(): mixed;

    protected function getUser(int|string $messengerToken): ?UserInterface
    {
        try {
            $user = $this->userRepository->getUserByMessengerToken($messengerToken);
        } catch (UserDoesNotExistsException) {
            $user = $this->authUser($messengerToken);
        }

        return $user;
    }

    private function authUser(int|string $messengerToken): ?UserInterface
    {
        try {
            $userId = $this->loginUser($messengerToken);
        } catch (UserDoesNotExistsException) {
            try {
                $userId = $this->registerUser($messengerToken);
            } catch (UserAlreadyExistsException|UserWasNotCreateException $exception) {
                $this->logger->emergency('Failed to register user from messenger', [
                    'exception' => $exception->getMessage(),
                    'messenger_id' => $messengerToken
                ]);

                return null;
            }
        }

        try {
            return $this->makeUser($userId, $messengerToken);
        } catch (InvalidValueException $exception) {
            $this->logger->emergency('Failed to save user in messenger repository', [
                'exception' => $exception->getMessage(),
                'messenger_id' => $messengerToken
            ]);

            return null;
        }
    }

    /**
     * @throws InvalidValueException
     */
    abstract protected function makeUser(int $userId, int|string $messengerToken): ?UserInterface;

    /**
     * @throws UserDoesNotExistsException
     */
    private function loginUser(int|string $messengerToken): int
    {
        $loginRequest = new MessengerLoginRequest($messengerToken);

        return $this->messengerLogin->execute($loginRequest)->getUserId();
    }

    /**
     * @throws UserAlreadyExistsException
     * @throws UserWasNotCreateException
     */
    private function registerUser(int|string $messengerToken): int
    {
        $registerRequest = new MessengerRegisterRequest($messengerToken);

        return $this->messengerRegister->execute($registerRequest)->getUserId();
    }

    protected function saveUser(): void
    {
        if ($this->context->isUserAuth() && $this->context->getUser()->isChangedMessageHandler()) {
            $user = $this->context->getUser();

            try {
                $this->userRepository->saveUser($user);
            } catch (UserDoesNotSaveException $exception) {
                $this->logger->emergency('Failed to save user', [
                    'exception' => $exception->getMessage(),
                    'user' => $user->toArray()
                ]);
            }
        }
    }

    /**
     * @throws HandlerDoesNotExistsException
     */
    protected function getMessageHandler(): HandlerInterface
    {
        try {
            $user = $this->context->getUser();
            $messageHandler = $user->getMessageHandler();

            if (!$messageHandler) {
                throw new HandlerDoesNotExistsException();
            }

            $user->setMessageHandler(null);

            return $this->handlers->getHandler(HandlerType::Message, $messageHandler);
        } catch (UserDoesNotAuthException $exception) {
            throw new HandlerDoesNotExistsException($exception->getMessage());
        }
    }

    /**
     * @return HandlerInterface
     * @throws HandlerDoesNotExistsException
     */
    public function getCallbackQueryHandler(): HandlerInterface
    {
        $callbackQuery = $this->context->getRequest()->getCallbackQuery();

        if (!$callbackQuery->getAction()) {
            throw new HandlerDoesNotExistsException();
        }

        return $this->handlers->getHandler(HandlerType::CallbackQuery, $callbackQuery->getAction());
    }
}
