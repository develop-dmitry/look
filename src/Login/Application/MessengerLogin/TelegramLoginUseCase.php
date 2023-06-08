<?php

declare(strict_types=1);

namespace Look\Login\Application\MessengerLogin;

use Look\Login\Application\MessengerLogin\Contract\MessengerLogin as MessengerLoginContract;
use Look\Login\Application\MessengerLogin\DTO\MessengerLoginRequest;
use Look\Login\Application\MessengerLogin\DTO\MessengerLoginResponse;
use Look\Login\Domain\User\Contract\UserRepository;
use Look\Login\Domain\User\Exception\UserDoesNotExistsException;

class TelegramLoginUseCase implements MessengerLoginContract
{
    public function __construct(
        protected UserRepository $userRepository
    ) {
    }

    public function execute(MessengerLoginRequest $request): MessengerLoginResponse
    {
        $user = $this->userRepository->getUserByTelegramToken($request->getToken());

        if (!$user->getId()) {
            throw new UserDoesNotExistsException();
        }

        return new MessengerLoginResponse($user->getId()->getValue());
    }
}
