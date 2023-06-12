<?php

declare(strict_types=1);

namespace Tests\Unit\LookSelection\Domain\Season;

use Look\LookSelection\Domain\Season\Entity\Season;
use Look\LookSelection\Domain\Season\Value\Name;
use Look\LookSelection\Domain\Season\Value\Slug;
use Tests\TestCase;

class SeasonTest extends TestCase
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
        $style = new Season($this->name, $this->slug);

        $this->assertEquals($this->slug->getValue(), $style->getSlug()->getValue());
    }

    public function testStyleShouldReturnName(): void
    {
        $style = new Season($this->name, $this->slug);

        $this->assertEquals($this->name->getValue(), $style->getName()->getValue());
    }
}
