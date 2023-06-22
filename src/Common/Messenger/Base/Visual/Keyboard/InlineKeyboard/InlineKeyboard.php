<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Base\Visual\Keyboard\InlineKeyboard;

use Look\Common\Messenger\Base\Visual\Keyboard\AbstractKeyboard;
use Look\Common\Messenger\Base\Visual\Keyboard\KeyboardType;

class InlineKeyboard extends AbstractKeyboard
{
    public function getKeyboardType(): KeyboardType
    {
        return KeyboardType::Inline;
    }
}
