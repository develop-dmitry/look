<?php

declare(strict_types=1);

namespace Look\Auth\Domain\User\Contract;

use Look\Auth\Domain\User\Exception\UserWasNotCreateException;
use Look\Auth\Domain\User\Exception\UserDoesNotExistsException;

interface UserRepositoryInterface
{
    /**
     * @param int $telegramToken
     * @return UserInterface
     * @throws UserDoesNotExistsException
     */
    public function getUserByTelegramToken(int $telegramToken): UserInterface;

    /**
     * @param UserInterface $user
     * @return void
     * @throws UserWasNotCreateException
     */
    public function createUser(UserInterface $user): void;

    /**
     * @param int $telegramToken
     * @return bool
     */
    public function isExistsUserWithTelegramToken(int $telegramToken): bool;
}
