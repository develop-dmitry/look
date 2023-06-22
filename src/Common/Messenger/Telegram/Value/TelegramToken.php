<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Telegram\Value;

use Look\Common\Exception\InvalidValueException;
use Look\Common\Value\MessengerToken\AbstractMessengerToken;

class TelegramToken extends AbstractMessengerToken
{
    protected function validate(int|string $value): void
    {
        if (!is_numeric($value)) {
            throw new InvalidValueException('Telegram token must be numeric');
        }

        $value = (int) $value;

        if ($value <= 0) {
            throw new InvalidValueException('Telegram token must be more than zero');
        }
    }
}
