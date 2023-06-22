<?php

declare(strict_types=1);

namespace Tests\Unit\Common\Messenger\Base\User;

use Look\Common\Messenger\Base\User\User;
use Look\Common\Messenger\Telegram\Value\TelegramToken;
use Look\Common\Value\Id\Id;
use Tests\TestCase;

class UserTest extends TestCase
{
    protected Id $id;

    protected TelegramToken $telegramToken;

    protected string $messageHandler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->id = new Id(1);
        $this->telegramToken = new TelegramToken(1);
        $this->messageHandler = 'test';
    }

    public function testUserShouldReturnId(): void
    {
        $user = new User($this->id, $this->telegramToken, $this->messageHandler);

        $this->assertEquals($this->id->getValue(), $user->getId()->getValue());
    }

    public function testUserToArray(): void
    {
        $user = new User($this->id, $this->telegramToken, $this->messageHandler);
        $userArray = $user->toArray();

        $this->assertEquals($this->id->getValue(), $userArray['id']);
        $this->assertEquals($this->messageHandler, $userArray['message_handler']);
    }

    public function testUserMustReturnTelegramToken(): void
    {
        $user = new User($this->id, $this->telegramToken, $this->messageHandler);

        $this->assertEquals($this->telegramToken->getValue(), $user->getMessengerToken()->getValue());
    }

    public function testUserMustReturnMessageHandler(): void
    {
        $user = new User($this->id, $this->telegramToken, $this->messageHandler);

        $this->assertEquals($this->messageHandler, $user->getMessageHandler());
    }

    public function testUserReturnNullMessengerHandler(): void
    {
        $user = new User($this->id, $this->telegramToken, null);

        $this->assertNull($user->getMessageHandler());
    }

    public function testSetUserMessageHandler(): void
    {
        $messageHandler = 'test_handler';
        $user = new User($this->id, $this->telegramToken, null);

        $user->setMessageHandler($messageHandler);

        $this->assertEquals($messageHandler, $user->getMessageHandler());
    }

    public function testUserIsChangedMessageHandlerMustReturnFalse(): void
    {
        $user = new User($this->id, $this->telegramToken, $this->messageHandler);

        $this->assertFalse($user->isChangedMessageHandler());
    }

    public function testUserIsChangedMessageHandlerMustReturnTrue(): void
    {
        $user = new User($this->id, $this->telegramToken, $this->messageHandler);
        $user->setMessageHandler('test');

        $this->assertTrue($user->isChangedMessageHandler());
    }
}
