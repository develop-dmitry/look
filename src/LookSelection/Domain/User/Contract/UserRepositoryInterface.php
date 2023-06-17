<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\User\Contract;

use Look\LookSelection\Domain\User\Exception\UserNotFoundException;

interface UserRepositoryInterface
{
    /**
     * @param int $id
     * @return UserInterface
     * @throws UserNotFoundException
     */
    public function getById(int $id): UserInterface;
}
