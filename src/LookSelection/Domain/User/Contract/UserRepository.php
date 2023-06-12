<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\User\Contract;

use Look\LookSelection\Domain\User\Exception\UserNotFoundException;

interface UserRepository
{
    /**
     * @param int $id
     * @return User
     * @throws UserNotFoundException
     */
    public function getById(int $id): User;
}
