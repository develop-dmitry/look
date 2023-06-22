<?php

declare(strict_types=1);

namespace Tests\Unit\Common\Messenger\Base\Visual\Keyboard;

use Look\Common\Messenger\Base\Visual\Button\ButtonInterface;
use Look\Common\Messenger\Base\Visual\Button\InlineButton\InlineButton;
use Look\Common\Messenger\Base\Visual\Keyboard\InlineKeyboard\InlineKeyboard;
use Look\Common\Messenger\Base\Visual\Keyboard\KeyboardInterface;
use Look\Common\Messenger\Base\Visual\Keyboard\KeyboardType;

class InlineKeyboardTest extends KeyboardTestCase
{
    public function testKeyboardShouldReturnType(): void
    {
        $keyboard = $this->makeKeyboard();

        $this->assertEquals(KeyboardType::Inline, $keyboard->getKeyboardType());
    }

    protected function makeKeyboard(array $options = []): KeyboardInterface
    {
        return new InlineKeyboard();
    }

    protected function makeButton(string $text): ButtonInterface
    {
        return new InlineButton($text);
    }
}
