<?php

declare(strict_types=1);

namespace Look\Auth\Application\MessengerLogin;

use Look\Auth\Application\MessengerLogin\Contract\MessengerLoginInterface as MessengerLoginContract;
use Look\Auth\Application\MessengerLogin\DTO\MessengerLoginRequest;
use Look\Auth\Application\MessengerLogin\DTO\MessengerLoginResponse;
use Look\Auth\Domain\User\Contract\UserRepositoryInterface;
use Look\Common\Exception\UserDoesNotExistsException;

class TelegramLoginUseCase implements MessengerLoginContract
{
    public function __construct(
        protected UserRepositoryInterface $userRepository
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
