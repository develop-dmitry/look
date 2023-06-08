<?php

declare(strict_types=1);

namespace Tests\Unit\Login\Domain;

use Look\Common\Exception\InvalidValueException;
use Look\Login\Domain\User\Value\TelegramToken;
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
}
