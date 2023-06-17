<?php

declare(strict_types=1);

namespace Look\Auth\Application\MessengerLogin\Contract;

use Look\Auth\Application\MessengerLogin\DTO\MessengerLoginRequest;
use Look\Auth\Application\MessengerLogin\DTO\MessengerLoginResponse;
use Look\Auth\Domain\User\Exception\UserDoesNotExistsException;

interface MessengerLoginInterface
{
    /**
     * @param MessengerLoginRequest $request
     * @return MessengerLoginResponse
     * @throws UserDoesNotExistsException
     */
    public function execute(MessengerLoginRequest $request): MessengerLoginResponse;
}
