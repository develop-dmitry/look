<?php

declare(strict_types=1);

namespace Look\Auth\Application\MessengerRegister;

use Look\Auth\Application\MessengerRegister\Contract\MessengerRegisterInterface;
use Look\Auth\Application\MessengerRegister\DTO\MessengerRegisterRequest;
use Look\Auth\Application\MessengerRegister\DTO\MessengerRegisterResponse;
use Look\Auth\Application\MessengerRegister\Exception\UserAlreadyExistsException;
use Look\Auth\Domain\User\Contract\UserRepositoryInterface;
use Look\Auth\Domain\User\Exception\UserWasNotCreateException;
use Look\Auth\Domain\User\User;
use Look\Auth\Domain\User\Value\TelegramToken;
use Look\Common\Exception\InvalidValueException;

class TelegramRegisterUseCase implements MessengerRegisterInterface
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
    ) {
    }

    public function execute(MessengerRegisterRequest $request): MessengerRegisterResponse
    {
        $telegramToken = $request->getToken();

        if ($this->userRepository->isExistsUserWithTelegramToken($telegramToken)) {
            throw new UserAlreadyExistsException("User with telegram token $telegramToken already exists");
        }

        $userId = $this->createUser($telegramToken);

        return new MessengerRegisterResponse($userId);
    }

    /**
     * @param int $telegramToken
     * @return int
     * @throws UserWasNotCreateException
     */
    protected function createUser(int $telegramToken): int
    {
        try {
            $user = new User(null, new TelegramToken($telegramToken));

            $this->userRepository->createUser($user);

            return $user->getId()?->getValue();
        } catch (InvalidValueException $exception) {
            throw new UserWasNotCreateException($exception->getMessage());
        }
    }
}
