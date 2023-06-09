<?php

declare(strict_types=1);

namespace Look\Auth\Infrastructure\Repository;

use Look\Auth\Domain\User\Exception\UserWasNotCreateException;
use Look\Common\Exception\InvalidValueException;
use Look\Auth\Domain\User\Contract\User;
use Look\Auth\Domain\User\Contract\UserRepository;
use App\Models\User as UserModel;
use Look\Auth\Domain\User\Entity\User as UserEntity;
use Look\Auth\Domain\User\Exception\UserDoesNotExistsException;
use Look\Auth\Domain\User\Value\Id;
use Look\Auth\Domain\User\Value\TelegramToken;
use Psr\Log\LoggerInterface;
use Throwable;

class EloquentUserRepository implements UserRepository
{
    public function __construct(
        protected LoggerInterface $logger
    ) {
    }

    public function getUserByTelegramToken(int $telegramToken): User
    {
        $user = UserModel::where('telegram_token', $telegramToken)
            ->select(['id', 'telegram_token'])
            ->first();

        if (!$user) {
            throw new UserDoesNotExistsException("User with telegram token $telegramToken does not exists");
        }

        try {
            return $this->makeUser($user);
        } catch (InvalidValueException $exception) {
            $this->logger->error('Invalid data in user database', ['user' => $user->toArray()]);
            throw new UserDoesNotExistsException($exception->getMessage());
        }
    }

    public function createUser(User $user): void
    {
        try {
            $userModel = new UserModel(['telegram_token' => $user->getTelegramToken()?->getValue()]);

            $userModel->saveOrFail();

            $user->setId(new Id($userModel->id));
        } catch (Throwable $exception) {
            throw new UserWasNotCreateException($exception->getMessage());
        }
    }

    public function isExistsUserWithTelegramToken(int $telegramToken): bool
    {
        return UserModel::where('telegram_token', $telegramToken)->exists();
    }

    /**
     * @throws InvalidValueException
     */
    protected function makeUser(UserModel $user): User
    {
        return new UserEntity(
            $user->id ? new Id($user->id) : null,
            $user->telegram_token ? new TelegramToken($user->telegram_token) : null
        );
    }
}
