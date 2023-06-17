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
use Look\LookSelection\Domain\Look\Look;
use Look\LookSelection\Domain\Look\Strategy\SuitableCalculatorStrategy;
use Look\LookSelection\Domain\Style\Style;
use Look\LookSelection\Domain\User\User;
use Look\LookSelection\Domain\Weather\Container\WeatherPeriod;
use Look\LookSelection\Domain\Weather\Entity\Weather;
use Look\LookSelection\Domain\Weather\Value\Temperature;
use Tests\TestCase;

class SuitableCalculatorStrategyTest extends TestCase
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
    }

    public function testCalculationSuitableScore(): void
    {
        $look = new Look(
            new Id(1),
            new Name('test'),
            new Photo('https://test.com/image.php'),
            new Slug('test'),
            $this->weather,
            [$this->jeansClothes, $this->shirtClothes, $this->sneakersClothes, $this->capClothes],
            []
        );
        $user = new User(new NullId(),
            [$this->casualStyle, $this->minimalStyle],
            [$this->shirtClothes, $this->sneakersClothes, $this->capClothes]
        );

        $suitableScoreStrategy = new SuitableCalculatorStrategy();

        $this->assertEquals(67.5, $suitableScoreStrategy->execute($look, $user));
    }

    public function testCalculationOneHundredPercentSuitableScore(): void
    {
        $look = new Look(
            new Id(1),
            new Name('test'),
            new Photo('https://test.com/image.php'),
            new Slug('test'),
            $this->weather,
            [$this->jeansClothes, $this->shirtClothes, $this->sneakersClothes, $this->capClothes],
            []
        );
        $user = new User(new NullId(),
            [$this->casualStyle, $this->minimalStyle, $this->sportStyle, $this->militaryStyle],
            [$this->shirtClothes, $this->sneakersClothes, $this->capClothes, $this->jeansClothes]
        );

        $suitableScoreStrategy = new SuitableCalculatorStrategy();

        $this->assertEquals(100, $suitableScoreStrategy->execute($look, $user));
    }

    public function testCalculationZeroPercentSuitableScore(): void
    {
        $look = new Look(
            new Id(1),
            new Name('test'),
            new Photo('https://test.com/image.php'),
            new Slug('test'),
            $this->weather,
            [$this->jeansClothes, $this->shirtClothes, $this->sneakersClothes, $this->capClothes],
            []
        );
        $user = new User(new NullId(),
            [],
            []
        );

        $suitableScoreStrategy = new SuitableCalculatorStrategy();

        $this->assertEquals(0, $suitableScoreStrategy->execute($look, $user));
    }
}
