<?php

declare(strict_types=1);

namespace Tests\Unit\Common\Value;

use Look\Common\Exception\InvalidValueException;
use Look\Common\Value\Temperature\Temperature;
use Tests\TestCase;

class TemperatureTest extends TestCase
{
    public function testValueWhichLessMinusFifty(): void
    {
        $this->expectException(InvalidValueException::class);
        new Temperature(-60);
    }

    public function testValueWhichEqualMinusFifty(): void
    {
        $this->expectException(InvalidValueException::class);
        new Temperature(-50);
    }

    public function testValueWhichMorePlusFifty(): void
    {
        $this->expectException(InvalidValueException::class);
        new Temperature(60);
    }

    public function testValueWhichEqualPlusFifty(): void
    {
        $this->expectException(InvalidValueException::class);
        new Temperature(50);
    }

    public function testValueWhichMoreMinusFiftyAndLessPlusFifty(): void
    {
        $this->expectNotToPerformAssertions();
        new Temperature(10);
    }
}
