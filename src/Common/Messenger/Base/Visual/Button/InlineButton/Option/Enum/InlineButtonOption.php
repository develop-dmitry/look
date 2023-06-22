<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Base\Visual\Button\InlineButton\Option\Enum;

enum InlineButtonOption: string
{
    case Url = 'url';

    case CallbackData = 'callback_data';
}
