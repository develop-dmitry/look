<?php

declare(strict_types=1);

namespace Tests\Unit\Auth\Domain;

use Look\Auth\Domain\User\User;
use Look\Auth\Domain\User\Value\TelegramToken;
use Look\Common\Value\Id\Id;
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

    public function testSetUserId(): void
    {
        $user = new User(null, null);
        $id = new Id(1);

        $user->setId($id);

        $this->assertEquals($id->getValue(), $user->getId()->getValue());
    }
}
