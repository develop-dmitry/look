<?php

declare(strict_types=1);

namespace Tests\Unit\Common\Value;

use Look\Common\Exception\InvalidValueException;
use Look\Common\Value\Id\Id;
use Tests\TestCase;

class IdTest extends TestCase
{
    public function testIdWhenValueLessZero(): void
    {
        $this->expectException(InvalidValueException::class);

        new Id(-5);
    }

    public function testIdWhenValueEqualZero(): void
    {
        $this->expectException(InvalidValueException::class);

        new Id(0);
    }

    public function testIdWhenValueMoreZero(): void
    {
        $this->expectNotToPerformAssertions();

        new Id(1);
    }

    public function testIdShouldNotBeNull(): void
    {
        $id = new Id(1);

        $this->assertFalse($id->isNull());
    }
}
