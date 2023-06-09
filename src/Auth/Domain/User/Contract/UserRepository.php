<?php

declare(strict_types=1);

namespace Look\Auth\Domain\User\Contract;

use Look\Auth\Domain\User\Exception\UserWasNotCreateException;
use Look\Auth\Domain\User\Exception\UserDoesNotExistsException;

interface UserRepository
{
    /**
     * @param int $telegramToken
     * @return User
     * @throws UserDoesNotExistsException
     */
    public function getUserByTelegramToken(int $telegramToken): User;

    /**
     * @param User $user
     * @return void
     * @throws UserWasNotCreateException
     */
    public function createUser(User $user): void;

    /**
     * @param int $telegramToken
     * @return bool
     */
    public function isExistsUserWithTelegramToken(int $telegramToken): bool;
}
