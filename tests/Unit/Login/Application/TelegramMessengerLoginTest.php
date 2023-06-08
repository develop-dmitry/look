<?php

declare(strict_types=1);

namespace Tests\Unit\Login\Application;

use Look\Login\Application\MessengerLogin\DTO\MessengerLoginRequest;
use Look\Login\Application\MessengerLogin\TelegramLoginUseCase;
use Look\Login\Domain\User\Contract\UserRepository;
use Look\Login\Domain\User\Entity\User;
use Look\Login\Domain\User\Exception\UserDoesNotExistsException;
use Look\Login\Domain\User\Value\Id;
use Look\Login\Domain\User\Value\TelegramToken;
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
        $userRepository = $this->getMockBuilder(UserRepository::class)->getMock();
        $userRepository
            ->method('getUserByTelegramToken')
            ->willThrowException(new UserDoesNotExistsException());

        $login = new TelegramLoginUseCase($userRepository);

        $this->expectException(UserDoesNotExistsException::class);
        $login->execute(new MessengerLoginRequest(2));
    }

    public function testLoginWhenUserExists(): void
    {
        $userRepository = $this->getMockBuilder(UserRepository::class)->getMock();
        $userRepository
            ->method('getUserByTelegramToken')
            ->willReturn($this->user);
        $login = new TelegramLoginUseCase($userRepository);

        $user = $login->execute(new MessengerLoginRequest($this->user->getTelegramToken()->getValue()));
        $this->assertEquals($this->user->getId()->getValue(), $user->getUserId());
    }
}
