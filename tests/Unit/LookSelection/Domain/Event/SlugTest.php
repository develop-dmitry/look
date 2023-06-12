<?php

declare(strict_types=1);

namespace Tests\Unit\LookSelection\Domain\Event;

use Look\Common\Exception\InvalidValueException;
use Look\LookSelection\Domain\Event\Value\Slug;
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

    public function testSlugShouldBeContainOnlyLatin(): void
    {
        $this->expectException(InvalidValueException::class);
        new Slug('тест');
    }

    public function testSlugBoundaryLength(): void
    {
        $value = str_repeat('b', 25);

        $this->expectNotToPerformAssertions();
        new Slug($value);
    }


    public function testSlugInvalidLength(): void
    {
        $value = str_repeat('b', 26);

        $this->expectException(InvalidValueException::class);
        new Slug($value);
    }
}
