<?php

declare(strict_types=1);

namespace Tests\Unit\Common\Messenger\Base\Visual\Keyboard;

use Look\Common\Messenger\Base\Visual\Button\ButtonInterface;
use Look\Common\Messenger\Base\Visual\Button\ReplyButton\ReplyButton;
use Look\Common\Messenger\Base\Visual\Keyboard\KeyboardInterface;
use Look\Common\Messenger\Base\Visual\Keyboard\KeyboardType;
use Look\Common\Messenger\Base\Visual\Keyboard\ReplyKeyboard\Option\Enum\ReplyKeyboardOption;
use Look\Common\Messenger\Base\Visual\Keyboard\ReplyKeyboard\Option\ResizeKeyboardOption;
use Look\Common\Messenger\Base\Visual\Keyboard\ReplyKeyboard\ReplyKeyboard;

class ReplyKeyboardTest extends KeyboardTestCase
{
    protected bool $keyboardResize = true;

    public function testKeyboardShouldReturnOptionWhenItAdded(): void
    {
        $keyboard = $this->makeKeyboard([new ResizeKeyboardOption($this->keyboardResize)]);

        $this->assertEquals(
            $this->keyboardResize,
            $keyboard->getOption(ReplyKeyboardOption::ResizeKeyboard->value)->getValue()
        );
    }

    public function testKeyboardShouldReturnType(): void
    {
        $keyboard = $this->makeKeyboard();

        $this->assertEquals(KeyboardType::Reply, $keyboard->getKeyboardType());
    }

    protected function makeKeyboard(array $options = []): KeyboardInterface
    {
        $keyboard = new ReplyKeyboard();

        foreach ($options as $option) {
            $keyboard->addOption($option);
        }

        return $keyboard;
    }

    protected function makeButton(string $text, array $options = []): ButtonInterface
    {
        return new ReplyButton($text);
    }
}
