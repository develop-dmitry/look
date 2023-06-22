<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Base\Visual\Keyboard\ReplyKeyboard\Option;

use Look\Common\Messenger\Base\Visual\Keyboard\ReplyKeyboard\Option\Enum\ReplyKeyboardOption;

class ResizeKeyboardOption extends AbstractReplyKeyboardOption
{
    public function __construct(bool $value)
    {
        parent::__construct($value);
    }

    public function getName(): string
    {
        return ReplyKeyboardOption::ResizeKeyboard->value;
    }
}
