<?php

declare(strict_types=1);

namespace Tests\Unit\LookSelection\Domain\Look;

use DateTime;
use Look\Common\Value\Id\Id;
use Look\Common\Value\Name\Name;
use Look\Common\Value\Photo\Photo;
use Look\Common\Value\Slug\Slug;
use Look\LookSelection\Domain\Clothes\Clothes;
use Look\LookSelection\Domain\Event\Event;
use Look\LookSelection\Domain\Look\Look;
use Look\LookSelection\Domain\Weather\Container\WeatherPeriod;
use Look\LookSelection\Domain\Weather\Entity\Weather;
use Look\LookSelection\Domain\Weather\Value\Temperature;
use Tests\TestCase;

class LookTest extends TestCase
{
    protected Id $id;

    protected Name $name;

    protected Slug $slug;

    protected Photo $photo;

    protected Weather $weather;

    protected array $clothes;

    protected array $events;

    protected function setUp(): void
    {
        parent::setUp();

        $this->id = new Id(1);
        $this->name = new Name('Тест');
        $this->slug = new Slug('test');
        $this->photo = new Photo('https://test.com/storage/image.png');
        $this->weather = new Weather(
            new Temperature(-10),
            new Temperature(10),
            new Temperature(0),
            WeatherPeriod::Morning,
            new DateTime()
        );
        $this->clothes = [new Clothes(
            new Id(1),
            new Name('Тест'),
            new Slug('test'),
            new Photo('https://test.com/storage/image.png'),
            []
        )];
        $this->events = [new Event(new Name('Тест'), new Slug('test'))];
    }

    public function testLookShouldReturnId(): void
    {
        $look = new Look(
            $this->id,
            $this->name,
            $this->photo,
            $this->slug,
            $this->weather,
            $this->clothes,
            $this->events
        );

        $this->assertEquals($this->id->getValue(), $look->getId()->getValue());
    }

    public function testLookShouldReturnName(): void
    {
        $look = new Look(
            $this->id,
            $this->name,
            $this->photo,
            $this->slug,
            $this->weather,
            $this->clothes,
            $this->events
        );

        $this->assertEquals($this->name->getValue(), $look->getName()->getValue());
    }

    public function testLookShouldReturnSlug(): void
    {
        $look = new Look(
            $this->id,
            $this->name,
            $this->photo,
            $this->slug,
            $this->weather,
            $this->clothes,
            $this->events
        );

        $this->assertEquals($this->slug->getValue(), $look->getSlug()->getValue());
    }

    public function testLookShouldReturnPhoto(): void
    {
        $look = new Look(
            $this->id,
            $this->name,
            $this->photo,
            $this->slug,
            $this->weather,
            $this->clothes,
            $this->events
        );

        $this->assertEquals($this->photo->getValue(), $look->getPhoto()->getValue());
    }

    public function testLookShouldReturnWeather(): void
    {
        $look = new Look(
            $this->id,
            $this->name,
            $this->photo,
            $this->slug,
            $this->weather,
            $this->clothes,
            $this->events
        );

        $weather = $look->getWeather();

        $this->assertEquals($this->weather->getPeriod(), $weather->getPeriod());
        $this->assertEquals($this->weather->getDate()->format('Y-m-d'), $weather->getDate()->format('Y-m-d'));
        $this->assertEquals($this->weather->getMinTemperature()->getValue(), $weather->getMinTemperature()->getValue());
        $this->assertEquals($this->weather->getMaxTemperature()->getValue(), $weather->getMaxTemperature()->getValue());
        $this->assertEquals(
            $this->weather->getAverageTemperature()->getValue(),
            $weather->getAverageTemperature()->getValue()
        );
    }

    public function testLookShouldReturnClothes(): void
    {
        $look = new Look(
            $this->id,
            $this->name,
            $this->photo,
            $this->slug,
            $this->weather,
            $this->clothes,
            $this->events
        );

        $this->assertNotEmpty($look->getClothes());
    }

    public function testLookWithoutClothesShouldReturnEmptyArray(): void
    {
        $look = new Look(
            $this->id,
            $this->name,
            $this->photo,
            $this->slug,
            $this->weather,
            [],
            $this->events
        );

        $this->assertEmpty($look->getClothes());
    }

    public function testLookShouldReturnEvents(): void
    {
        $look = new Look(
            $this->id,
            $this->name,
            $this->photo,
            $this->slug,
            $this->weather,
            $this->clothes,
            $this->events
        );

        $this->assertNotEmpty($look->getEvents());
    }

    public function testLookWithoutEventsShouldReturnEmptyArray(): void
    {
        $look = new Look(
            $this->id,
            $this->name,
            $this->photo,
            $this->slug,
            $this->weather,
            $this->clothes,
            []
        );

        $this->assertEmpty($look->getEvents());
    }
}
