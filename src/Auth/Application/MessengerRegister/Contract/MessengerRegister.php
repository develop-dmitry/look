<?php

declare(strict_types=1);

namespace Look\Auth\Application\MessengerRegister\Contract;

use Look\Auth\Application\MessengerRegister\DTO\MessengerRegisterRequest;
use Look\Auth\Application\MessengerRegister\DTO\MessengerRegisterResponse;
use Look\Auth\Application\MessengerRegister\Exception\UserAlreadyExistsException;
use Look\Auth\Domain\User\Exception\UserWasNotCreateException;

interface MessengerRegister
{
    /**
     * @param MessengerRegisterRequest $request
     * @return MessengerRegisterResponse
     * @throws UserWasNotCreateException
     * @throws UserAlreadyExistsException
     */
    public function execute(MessengerRegisterRequest $request): MessengerRegisterResponse;
}
