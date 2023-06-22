<?php

declare(strict_types=1);

namespace Tests\Unit\Common\Messenger\Telegram;

use Look\Common\Exception\UserDoesNotExistsException;
use Look\Common\Messenger\Base\User\Contract\UserInterface;
use Look\Common\Messenger\Base\User\User;
use Look\Common\Messenger\Telegram\Repository\TelegramUserRepository;
use Look\Common\Messenger\Telegram\Value\TelegramToken;
use Look\Common\Value\Id\Id;
use Tests\TestCase;

class TelegramUserRepositoryTest extends TestCase
{
    protected UserInterface $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = new User(new Id(1), new TelegramToken(1), 'test');
    }

    public function testSaveUser(): void
    {
        $telegramUserRepository = new TelegramUserRepository();

        $this->expectNotToPerformAssertions();
        $telegramUserRepository->saveUser($this->user);
    }

    public function testGettingExistsUserByMessengerToken(): void
    {
        $telegramUserRepository = new TelegramUserRepository();
        $user = $telegramUserRepository->getUserByMessengerToken($this->user->getMessengerToken()->getValue());

        $this->assertEquals($this->user->getId()->getValue(), $user->getId()->getValue());
    }

    public function testGettingNotExistsUserByMessengerToken(): void
    {
        $telegramUserRepository = new TelegramUserRepository();

        $this->expectException(UserDoesNotExistsException::class);
        $telegramUserRepository->getUserByMessengerToken(131231321);
    }
}
