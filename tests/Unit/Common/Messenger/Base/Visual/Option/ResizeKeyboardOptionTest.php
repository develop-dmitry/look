<?php

declare(strict_types=1);

namespace Tests\Unit\Common\Messenger\Base\Visual\Option;

use Look\Common\Messenger\Base\Visual\Keyboard\ReplyKeyboard\Option\ResizeKeyboardOption;
use Look\Common\Messenger\Base\Visual\Option\Contract\OptionInterface;

class ResizeKeyboardOptionTest extends OptionTestCase
{
    protected string $name = 'resize_keyboard';

    protected mixed $defaultValue = true;

    public function testOptionReturnFalse(): void
    {
        $option = $this->makeOption(false);

        $this->assertFalse($option->getValue());
    }

    protected function makeOption(mixed $value): OptionInterface
    {
        return new ResizeKeyboardOption($value);
    }
}
