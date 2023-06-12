<?php

declare(strict_types=1);

namespace Tests\Unit\LookSelection\Domain\Clothes;

use Look\Common\Value\Id\Id;
use Look\Common\Value\Name\Name;
use Look\Common\Value\Slug\Slug;
use Look\LookSelection\Domain\Clothes\Entity\Clothes;
use Look\LookSelection\Domain\Clothes\Value\Photo;
use Look\LookSelection\Domain\Style\Entity\Style;
use Tests\TestCase;

class ClothesTest extends TestCase
{
    protected Id $id;

    protected Name $name;

    protected Slug $slug;

    protected Photo $photo;

    protected array $styles;

    protected function setUp(): void
    {
        parent::setUp();

        $this->id = new Id(1);
        $this->name = new Name('Тест');
        $this->slug = new Slug('slug');
        $this->photo = new Photo('https://test.com/storage/image.png');
        $this->styles = [new Style(new Name('Тест'), new Slug('test'))];
    }

    public function testClothesShouldReturnId(): void
    {
        $clothes = new Clothes($this->id, $this->name, $this->slug, $this->photo, $this->styles);

        $this->assertEquals($this->id->getValue(), $clothes->getId()->getValue());
    }

    public function testClothesShouldReturnName(): void
    {
        $clothes = new Clothes($this->id, $this->name, $this->slug, $this->photo, $this->styles);

        $this->assertEquals($this->name->getValue(), $clothes->getName()->getValue());
    }

    public function testClothesShouldReturnSlug(): void
    {
        $clothes = new Clothes($this->id, $this->name, $this->slug, $this->photo, $this->styles);

        $this->assertEquals($this->slug->getValue(), $clothes->getSlug()->getValue());
    }

    public function testClothesShouldReturnPhoto(): void
    {
        $clothes = new Clothes($this->id, $this->name, $this->slug, $this->photo, $this->styles);

        $this->assertEquals($this->photo->getValue(), $clothes->getPhoto()->getValue());
    }

    public function testClothesShouldReturnStyles(): void
    {
        $clothes = new Clothes($this->id, $this->name, $this->slug, $this->photo, $this->styles);

        $this->assertCount(1, $clothes->getStyles());
    }

    public function testClothesWithoutStylesShouldReturnEmptyArray(): void
    {
        $clothes = new Clothes($this->id, $this->name, $this->slug, $this->photo, []);

        $this->assertEmpty($clothes->getStyles());
    }
}
