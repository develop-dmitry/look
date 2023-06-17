<?php

declare(strict_types=1);

namespace Tests\Unit\LookSelection\Domain\Look;

use DateTime;
use Look\Common\Value\Id\Id;
use Look\Common\Value\Id\NullId;
use Look\Common\Value\Name\Name;
use Look\Common\Value\Photo\Photo;
use Look\Common\Value\Slug\Slug;
use Look\LookSelection\Domain\Clothes\Clothes;
use Look\LookSelection\Domain\Event\Event;
use Look\LookSelection\Domain\Look\Contract\LookRepositoryInterface;
use Look\LookSelection\Domain\Look\Contract\SuitableCalculatorStrategyInterface;
use Look\LookSelection\Domain\Look\Look;
use Look\LookSelection\Domain\Look\Service\LookSelectionService;
use Look\LookSelection\Domain\Style\Style;
use Look\LookSelection\Domain\User\User;
use Look\LookSelection\Domain\Weather\Container\WeatherPeriod;
use Look\LookSelection\Domain\Weather\Value\Temperature;
use Look\LookSelection\Domain\Weather\Weather;
use Tests\TestCase;

class LookSelectionServiceTest extends TestCase
{
    protected Weather $weather;

    protected Style $casualStyle;

    protected Style $sportStyle;

    protected Style $militaryStyle;

    protected Style $minimalStyle;

    protected Clothes $jeansClothes;

    protected Clothes $shirtClothes;

    protected Clothes $sneakersClothes;

    protected Clothes $capClothes;

    protected Event $event;

    protected function setUp(): void
    {
        parent::setUp();

        $this->weather = new Weather(
            new Temperature(-10),
            new Temperature(10),
            new Temperature(0),
            WeatherPeriod::Morning,
            new DateTime()
        );

        $this->casualStyle = new Style(new Name('Casual'), new Slug('casual'));
        $this->sportStyle = new Style(new Name('Sport'), new Slug('sport'));
        $this->militaryStyle = new Style(new Name('Military'), new Slug('military'));
        $this->minimalStyle = new Style(new Name('Minimal'), new Slug('minimal'));

        $this->jeansClothes = new Clothes(
            new Id(1),
            new Name('Jeans'),
            new Slug('jeans'),
            new Photo('https://test.com/image.php'),
            [$this->casualStyle, $this->sportStyle]
        );
        $this->shirtClothes = new Clothes(
            new Id(2),
            new Name('Shirt'),
            new Slug('shirt'),
            new Photo('https://test.com/image.php'),
            [$this->casualStyle, $this->militaryStyle]
        );
        $this->sneakersClothes = new Clothes(
            new Id(3),
            new Name('Sneakers'),
            new Slug('sneakers'),
            new Photo('https://test.com/image.php'),
            [$this->minimalStyle, $this->militaryStyle]
        );
        $this->capClothes = new Clothes(
            new Id(4),
            new Name('Cap'),
            new Slug('cap'),
            new Photo('https://test.com/image.php'),
            [$this->sportStyle, $this->militaryStyle]
        );

        $this->event = new Event(new Name('Тест'), new Slug('test'));
    }

    public function testPickLook(): void
    {
        $looks = [
            new Look(
                new Id(1),
                new Name('test'),
                new Photo('https://test.com/image.php'),
                new Slug('test'),
                $this->weather,
                [$this->jeansClothes, $this->sneakersClothes],
                [$this->event]
            ),
            new Look(
                new Id(2),
                new Name('test 2'),
                new Photo('https://test.com/image.php'),
                new Slug('test-two'),
                $this->weather,
                [$this->jeansClothes, $this->shirtClothes, $this->sneakersClothes, $this->capClothes],
                [$this->event]
            ),
            new Look(
                new Id(3),
                new Name('test 3'),
                new Photo('https://test.com/image.php'),
                new Slug('test-three'),
                $this->weather,
                [$this->jeansClothes, $this->shirtClothes, $this->sneakersClothes],
                [$this->event]
            ),
        ];

        $lookRepository = $this->getMockBuilder(LookRepositoryInterface::class)->getMock();
        $lookRepository
            ->method('findByEventAndWeather')
            ->willReturn($looks);

        $user = new User(new NullId(),
            [$this->militaryStyle, $this->minimalStyle],
            [$this->shirtClothes, $this->sneakersClothes, $this->capClothes]
        );

        $lookSelectionService = new LookSelectionService(
            $lookRepository,
            $this->app->make(SuitableCalculatorStrategyInterface::class)
        );

        $selectionLooks = $lookSelectionService->pickLook($user, $this->event, $this->weather);

        $this->assertCount(count($looks), $selectionLooks);
        $this->assertEquals(2, $selectionLooks[0]->getId()->getValue());
        $this->assertEquals(3, $selectionLooks[1]->getId()->getValue());
        $this->assertEquals(1, $selectionLooks[2]->getId()->getValue());
    }

    public function testPickLookWhenRepositoryReturnEmptyArray(): void
    {
        $lookRepository = $this->getMockBuilder(LookRepositoryInterface::class)->getMock();
        $lookRepository
            ->method('findByEventAndWeather')
            ->willReturn([]);

        $user = new User(new NullId(),
            [$this->militaryStyle, $this->minimalStyle],
            [$this->shirtClothes, $this->sneakersClothes, $this->capClothes]
        );

        $lookSelectionService = new LookSelectionService(
            $lookRepository,
            $this->app->make(SuitableCalculatorStrategyInterface::class)
        );

        $this->assertEmpty($lookSelectionService->pickLook($user, $this->event, $this->weather));
    }
}
