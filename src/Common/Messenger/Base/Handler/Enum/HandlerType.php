<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Base\Handler\Enum;

enum HandlerType: string
{
    case Message = 'message';

    case CallbackQuery = 'callback_query';

    case Text = 'text';

    case Command = 'command';
}
