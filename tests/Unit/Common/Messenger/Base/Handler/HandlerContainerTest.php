<?php

declare(strict_types=1);

namespace Tests\Unit\Common\Messenger\Base\Handler;

use Look\Common\Messenger\Base\Handler\Enum\HandlerType;
use Look\Common\Messenger\Base\Handler\HandlerContainer\HandlerContainer;
use Look\Common\Messenger\Base\Handler\HandlerInterface;
use Tests\TestCase;

class HandlerContainerTest extends TestCase
{
    public function testAddCommandHandler(): void
    {
        $handler = $this->getMockBuilder(HandlerInterface::class)->getMock();
        $handlerContainer = new HandlerContainer();

        $handlerContainer->addCommandHandler('test', $handler);

        $this->assertTrue($handlerContainer->hasHandler(HandlerType::Command, 'test'));
    }

    public function testAddTextHandler(): void
    {
        $handler = $this->getMockBuilder(HandlerInterface::class)->getMock();
        $handlerContainer = new HandlerContainer();

        $handlerContainer->addTextHandler('test', $handler);

        $this->assertTrue($handlerContainer->hasHandler(HandlerType::Text, 'test'));
    }

    public function testAddMessageHandler(): void
    {
        $handler = $this->getMockBuilder(HandlerInterface::class)->getMock();
        $handlerContainer = new HandlerContainer();

        $handlerContainer->addMessageHandler('test', $handler);

        $this->assertTrue($handlerContainer->hasHandler(HandlerType::Message, 'test'));
    }

    public function testAddCallbackQueryHandler(): void
    {
        $handler = $this->getMockBuilder(HandlerInterface::class)->getMock();
        $handlerContainer = new HandlerContainer();

        $handlerContainer->addCallbackQueryHandler('test', $handler);

        $this->assertTrue($handlerContainer->hasHandler(HandlerType::CallbackQuery, 'test'));
    }

    public function testGettingHandlers(): void
    {
        $handlerContainer = (new HandlerContainer())
            ->addCallbackQueryHandler(
                'test',
                $this->getMockBuilder(HandlerInterface::class)->getMock()
            )
            ->addCallbackQueryHandler(
                'test2',
                $this->getMockBuilder(HandlerInterface::class)->getMock()
            );

        $this->assertCount(2, $handlerContainer->getHandlers(HandlerType::CallbackQuery));
    }

    public function testGettingHandler(): void
    {
        $handlerContainer = (new HandlerContainer())
            ->addCallbackQueryHandler('test', $this->getMockBuilder(HandlerInterface::class)->getMock());

        $this->expectNotToPerformAssertions();
        $handlerContainer->getHandler(HandlerType::CallbackQuery, 'test');
    }
}
