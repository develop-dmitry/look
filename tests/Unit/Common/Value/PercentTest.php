<?php

declare(strict_types=1);

namespace Tests\Unit\Common\Value;

use Look\Common\Exception\InvalidValueException;
use Look\Common\Value\Percent\Percent;
use Tests\TestCase;

class PercentTest extends TestCase
{
    public function testPercentShouldReturnValue(): void
    {
        $percent = new Percent(50);

        $this->assertEquals(50, $percent->getValue());
    }

    public function testPercentShouldBeMoreOrEqualZero(): void
    {
        $this->expectException(InvalidValueException::class);
        new Percent(-1);
    }

    public function testPercentShouldBeLessOrEqualOneHundred(): void
    {
        $this->expectException(InvalidValueException::class);
        new Percent(101);
    }
}
