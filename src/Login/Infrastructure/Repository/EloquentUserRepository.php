<?php

declare(strict_types=1);

namespace Look\Login\Infrastructure\Repository;

use Look\Common\Exception\InvalidValueException;
use Look\Login\Domain\User\Contract\User;
use Look\Login\Domain\User\Contract\UserRepository;
use App\Models\User as UserModel;
use Look\Login\Domain\User\Entity\User as UserEntity;
use Look\Login\Domain\User\Exception\UserDoesNotExistsException;
use Look\Login\Domain\User\Value\Id;
use Look\Login\Domain\User\Value\TelegramToken;
use Psr\Log\LoggerInterface;

class EloquentUserRepository implements UserRepository
{
    public function __construct(
        protected LoggerInterface $logger
    ) {
    }

    public function getUserByTelegramToken(int $telegramToken): User
    {
        $user = UserModel::where('telegram_token', $telegramToken)->first();

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
