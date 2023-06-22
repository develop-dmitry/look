<?php

declare(strict_types=1);

namespace Tests\Unit\Common\Messenger\Base\Visual;

use Look\Common\Messenger\Base\Visual\Keyboard\ReplyKeyboard\ReplyKeyboard;
use Look\Common\Messenger\Base\Visual\Visual;
use Tests\TestCase;

class VisualTest extends TestCase
{
    public function testVisualReturnEmptyMessageWhenItNotSet(): void
    {
        $visual = new Visual();

        $this->assertEquals('', $visual->getMessage());
    }

    public function testVisualReturnMessageWhichItSet(): void
    {
        $visual = new Visual();
        $message = 'test';

        $visual->setMessage($message);

        $this->assertEquals($message, $visual->getMessage());
    }

    public function testVisualReturnNotEditMessageWhenItNotSet(): void
    {
        $visual = new Visual();

        $this->assertFalse($visual->isEditMessage());
    }

    public function testVisualReturnEditWhenItSet(): void
    {
        $visual = new Visual();
        $visual->editMessage(true);

        $this->assertTrue($visual->isEditMessage());
    }

    public function testVisualReturnNullWhenKeyboardNotSet(): void
    {
        $visual = new Visual();

        $this->assertNull($visual->getKeyboard());
    }

    public function testVisualReturnKeyboardWhenItSet(): void
    {
        $visual = new Visual();
        $visual->setKeyboard(new ReplyKeyboard());

        $this->assertNotNull($visual->getKeyboard());
    }
}
