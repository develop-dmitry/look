<?php

declare(strict_types=1);

namespace Look\Login\Application\MessengerLogin\Contract;

use Look\Login\Application\MessengerLogin\DTO\MessengerLoginRequest;
use Look\Login\Application\MessengerLogin\DTO\MessengerLoginResponse;
use Look\Login\Domain\User\Exception\UserDoesNotExistsException;

interface MessengerLogin
{
    /**
     * @param MessengerLoginRequest $request
     * @return MessengerLoginResponse
     * @throws UserDoesNotExistsException
     */
    public function execute(MessengerLoginRequest $request): MessengerLoginResponse;
}
