<?php

declare(strict_types=1);

namespace Tests\Unit\Common\Messenger\Telegram;

use Look\Common\Exception\InvalidValueException;
use Look\Common\Messenger\Telegram\Value\TelegramToken;
use Tests\TestCase;

class TelegramTokenTest extends TestCase
{
    public function testTelegramTokenWhenValueLessZero(): void
    {
        $this->expectException(InvalidValueException::class);
        new TelegramToken(-5);
    }

    public function testTelegramTokenWhenValueEqualZero(): void
    {
        $this->expectException(InvalidValueException::class);
        new TelegramToken(0);
    }

    public function testTelegramTokenWhenValueMoreZero(): void
    {
        $this->expectNotToPerformAssertions();
        new TelegramToken(1);
    }

    public function testTelegramTokenMustBeNumeric(): void
    {
        $this->expectException(InvalidValueException::class);
        new TelegramToken('test');
    }
}
