<?php

declare(strict_types=1);

namespace Tests\Unit\LookSelection\Domain\Style;

use Look\LookSelection\Domain\Style\Entity\Style;
use Look\LookSelection\Domain\Style\Value\Name;
use Look\LookSelection\Domain\Style\Value\Slug;
use Tests\TestCase;

class StyleTest extends TestCase
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
        $style = new Style($this->name, $this->slug);

        $this->assertEquals($this->slug->getValue(), $style->getSlug()->getValue());
    }

    public function testStyleShouldReturnName(): void
    {
        $style = new Style($this->name, $this->slug);

        $this->assertEquals($this->name->getValue(), $style->getName()->getValue());
    }
}
