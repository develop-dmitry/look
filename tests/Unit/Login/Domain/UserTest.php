<?php

declare(strict_types=1);

namespace Tests\Unit\Login\Domain;

use Look\Login\Domain\User\Entity\User;
use Look\Login\Domain\User\Value\Id;
use Look\Login\Domain\User\Value\TelegramToken;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testUserShouldReturnNullId(): void
    {
        $user = new User(null, null);

        $this->assertNull($user->getId());
    }

    public function testUserShouldReturnId(): void
    {
        $id = new Id(1);
        $user = new User($id, null);

        $this->assertEquals($id->getValue(), $user->getId()->getValue());
    }

    public function testUserShouldReturnNullTelegramToken(): void
    {
        $user = new User(null, null);

        $this->assertNull($user->getTelegramToken());
    }

    public function testUserShouldReturnTelegramToken(): void
    {
        $telegramToken = new TelegramToken(1);
        $user = new User(null, $telegramToken);

        $this->assertEquals($telegramToken->getValue(), $user->getTelegramToken()->getValue());
    }
}
