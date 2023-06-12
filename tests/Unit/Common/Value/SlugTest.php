<?php

declare(strict_types=1);

namespace Tests\Unit\Common\Value;

use Look\Common\Exception\InvalidValueException;
use Look\Common\Value\Slug\Slug;
use Tests\TestCase;

class SlugTest extends TestCase
{
    public function testSlugShouldReturnValue(): void
    {
        $slug = new Slug('test');

        $this->assertEquals('test', $slug->getValue());
    }

    public function testSlugCouldNotBeEmpty(): void
    {
        $this->expectException(InvalidValueException::class);
        new Slug('');
    }

    public function testSlugShouldBeContainOnlyLatinSymbols(): void
    {
        $this->expectException(InvalidValueException::class);
        new Slug('тест');
    }

    public function testSlugBoundaryLength(): void
    {
        $value = str_repeat('b', 100);

        $this->expectNotToPerformAssertions();
        new Slug($value);
    }


    public function testSlugInvalidLength(): void
    {
        $value = str_repeat('b', 101);

        $this->expectException(InvalidValueException::class);
        new Slug($value);
    }
}
