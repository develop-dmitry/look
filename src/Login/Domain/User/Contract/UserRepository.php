<?php

declare(strict_types=1);

namespace Look\Login\Domain\User\Contract;

use Look\Login\Domain\User\Exception\UserDoesNotExistsException;

interface UserRepository
{
    /**
     * @param int $telegramToken
     * @return User
     * @throws UserDoesNotExistsException
     */
    public function getUserByTelegramToken(int $telegramToken): User;
}
