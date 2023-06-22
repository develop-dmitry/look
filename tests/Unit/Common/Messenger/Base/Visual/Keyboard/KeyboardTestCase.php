<?php

declare(strict_types=1);

namespace Tests\Unit\Common\Messenger\Base\Visual\Keyboard;

use Look\Common\Messenger\Base\Visual\Button\ButtonInterface;
use Look\Common\Messenger\Base\Visual\Keyboard\KeyboardInterface;
use Tests\TestCase;

abstract class KeyboardTestCase extends TestCase
{
    public function testKeyboardShouldReturnEmptyArrayWhenRowsAreNotAdded(): void
    {
        $keyboard = $this->makeKeyboard();

        $this->assertEmpty($keyboard->getRows());
    }

    public function testKeyboardShouldReturnTwoRowsWhenAddedTwoRows(): void
    {
        $keyboard = $this->makeKeyboard();

        $keyboard->addRow($this->makeButton('test'));
        $keyboard->addRow($this->makeButton('test2'));

        $this->assertCount(2, $keyboard->getRows());
    }

    public function testKeyboardShouldReturnRowWhenAddedTwoButtonInRow(): void
    {
        $keyboard = $this->makeKeyboard();

        $keyboard->addRow($this->makeButton('test'), $this->makeButton('test2'));

        $this->assertCount(1, $keyboard->getRows());
    }

    abstract public function testKeyboardShouldReturnType(): void;

    abstract protected function makeKeyboard(array $options = []): KeyboardInterface;

    abstract protected function makeButton(string $text): ButtonInterface;
}
