<?php

declare(strict_types=1);

namespace Tests\Unit\LookSelection\Domain\Style;

use Look\Common\Exception\InvalidValueException;
use Look\LookSelection\Domain\Style\Value\Name;
use Tests\TestCase;

class NameTest extends TestCase
{
    public function testNameShouldReturnValue(): void
    {
        $name = new Name('test');

        $this->assertEquals('test', $name->getValue());
    }

    public function testNameShouldNotBeEmpty(): void
    {
        $this->expectException(InvalidValueException::class);
        new Name('');
    }

    public function testNameBoundaryLength(): void
    {
        $value = str_repeat('а', 25);

        $this->expectNotToPerformAssertions();
        new Name($value);
    }

    public function testNameInvalidLength(): void
    {
        $value = str_repeat('а', 26);

        $this->expectException(InvalidValueException::class);
        new Name($value);
    }
}
