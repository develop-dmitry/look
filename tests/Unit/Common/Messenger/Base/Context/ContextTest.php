<?php

declare(strict_types=1);

namespace Tests\Unit\Common\Messenger\Base\Context;

use Look\Common\Messenger\Base\Context\Context;
use Look\Common\Messenger\Base\Context\Exception\UserDoesNotAuthException;
use Look\Common\Messenger\Base\Request\CallbackQuery\CallbackQuery;
use Look\Common\Messenger\Base\Request\Geolocation\Geolocation;
use Look\Common\Messenger\Base\Request\Request;
use Look\Common\Messenger\Base\User\User;
use Look\Common\Messenger\Telegram\Value\TelegramToken;
use Look\Common\Value\Id\Id;
use Tests\TestCase;

class ContextTest extends TestCase
{
    protected Request $request;

    protected User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->request = new Request(
            'Test',
            CallbackQuery::createEmpty(),
            new Geolocation(57, 53)
        );

        $this->user = new User(new Id(1), new TelegramToken(1), 'test');
    }

    public function testContextShouldReturnRequest(): void
    {
        $context = new Context($this->request, null);

        $this->assertEquals($this->request->getMessage(), $context->getRequest()->getMessage());
    }

    public function testContextShouldReturnUser(): void
    {
        $context = new Context($this->request, $this->user);

        $this->assertEquals($this->user->getId()->getValue(), $context->getUser()->getId()->getValue());
    }

    public function testContextWhenUserIsNotAuth(): void
    {
        $context = new Context($this->request, null);

        $this->assertFalse($context->isUserAuth());
    }

    public function testContextWhenUserIsAuth(): void
    {
        $context = new Context($this->request, $this->user);

        $this->assertTrue($context->isUserAuth());
    }

    public function testContextUserExceptionWhenUserIsNotAuth(): void
    {
        $context = new Context($this->request, null);

        $this->expectException(UserDoesNotAuthException::class);
        $context->getUser();
    }
}
