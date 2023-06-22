<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Base\User\Contract;

use Look\Common\Exception\UserDoesNotExistsException;
use Look\Common\Messenger\Base\Exception\UserDoesNotSaveException;

interface UserRepositoryInterface
{
    /**
     * @param UserInterface $user
     * @return void
     * @throws UserDoesNotSaveException
     */
    public function saveUser(UserInterface $user): void;

    /**
     * @param string|int $messengerToken
     * @return UserInterface
     * @throws UserDoesNotExistsException
     */
    public function getUserByMessengerToken(string|int $messengerToken): UserInterface;
}
