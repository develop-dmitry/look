<?php

declare(strict_types=1);

namespace Tests\Unit\LookSelection\Domain\Event;

use Look\LookSelection\Domain\Event\Entity\Event;
use Look\LookSelection\Domain\Event\Value\Name;
use Look\LookSelection\Domain\Event\Value\Slug;
use Tests\TestCase;

class EventTest extends TestCase
{
    protected Slug $slug;

    protected Name $name;

    protected function setUp(): void
    {
        parent::setUp();

        $this->slug = new Slug('test');
        $this->name = new Name('Название');
    }

    public function testStyleShouldReturnSlug(): void
    {
        $style = new Event($this->name, $this->slug);

        $this->assertEquals($this->slug->getValue(), $style->getSlug()->getValue());
    }

    public function testStyleShouldReturnName(): void
    {
        $style = new Event($this->name, $this->slug);

        $this->assertEquals($this->name->getValue(), $style->getName()->getValue());
    }
}
