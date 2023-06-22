<?php

declare(strict_types=1);

namespace Tests\Unit\Auth\Application;

use Look\Auth\Application\MessengerLogin\DTO\MessengerLoginRequest;
use Look\Auth\Application\MessengerLogin\TelegramLoginUseCase;
use Look\Auth\Domain\User\Contract\UserRepositoryInterface;
use Look\Auth\Domain\User\User;
use Look\Auth\Domain\User\Value\TelegramToken;
use Look\Common\Exception\UserDoesNotExistsException;
use Look\Common\Value\Id\Id;
use Tests\TestCase;

class TelegramMessengerLoginTest extends TestCase
{
    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = new User(new Id(1), new TelegramToken(1));
    }

    public function testLoginWhenUserDoesNotExists(): void
    {
        $userRepository = $this->getMockBuilder(UserRepositoryInterface::class)->getMock();
        $userRepository
            ->method('getUserByTelegramToken')
            ->willThrowException(new UserDoesNotExistsException());

        $login = new TelegramLoginUseCase($userRepository);

        $this->expectException(UserDoesNotExistsException::class);
        $login->execute(new MessengerLoginRequest(2));
    }

    public function testLoginWhenUserExists(): void
    {
        $userRepository = $this->getMockBuilder(UserRepositoryInterface::class)->getMock();
        $userRepository
            ->method('getUserByTelegramToken')
            ->willReturn($this->user);
        $login = new TelegramLoginUseCase($userRepository);

        $user = $login->execute(new MessengerLoginRequest($this->user->getTelegramToken()->getValue()));
        $this->assertEquals($this->user->getId()->getValue(), $user->getUserId());
    }
}
