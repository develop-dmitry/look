<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Base\Visual\Keyboard\ReplyKeyboard;

use Look\Common\Messenger\Base\Visual\Keyboard\AbstractKeyboard;
use Look\Common\Messenger\Base\Visual\Keyboard\KeyboardType;
use Look\Common\Messenger\Base\Visual\Keyboard\ReplyKeyboard\Option\AbstractReplyKeyboardOption;

class ReplyKeyboard extends AbstractKeyboard
{
    public function addOption(AbstractReplyKeyboardOption $option): self
    {
        $this->options[$option->getName()] = $option;
        return $this;
    }

    public function getKeyboardType(): KeyboardType
    {
        return KeyboardType::Reply;
    }
}
