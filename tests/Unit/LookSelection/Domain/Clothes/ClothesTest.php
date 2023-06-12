<?php

declare(strict_types=1);

namespace Tests\Unit\LookSelection\Domain\Clothes;

use Look\LookSelection\Domain\Clothes\Entity\Clothes;
use Look\LookSelection\Domain\Clothes\Value\Name;
use Look\LookSelection\Domain\Clothes\Value\Photo;
use Look\LookSelection\Domain\Clothes\Value\Slug;
use Tests\TestCase;

class ClothesTest extends TestCase
{
    protected Name $name;

    protected Slug $slug;

    protected Photo $photo;

    protected function setUp(): void
    {
        parent::setUp();

        $this->name = new Name('Тест');
        $this->slug = new Slug('slug');
        $this->photo = new Photo('/storage/image.png');
    }

    public function testClothesShouldReturnName(): void
    {
        $clothes = new Clothes($this->name, $this->slug, $this->photo);

        $this->assertEquals($this->name->getValue(), $clothes->getName()->getValue());
    }

    public function testClothesShouldReturnSlug(): void
    {
        $clothes = new Clothes($this->name, $this->slug, $this->photo);

        $this->assertEquals($this->slug->getValue(), $clothes->getSlug()->getValue());
    }

    public function testClothesShouldReturnPhoto(): void
    {
        $clothes = new Clothes($this->name, $this->slug, $this->photo);

        $this->assertEquals($this->photo->getValue(), $clothes->getPhoto()->getValue());
    }
}
