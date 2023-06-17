<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Look;

use Look\Common\Value\Id\IdInterface;
use Look\Common\Value\Name\NameInterface;
use Look\Common\Value\Percent\Percent;
use Look\Common\Value\Photo\PhotoInterface;
use Look\Common\Value\Slug\SlugInterface;
use Look\LookSelection\Domain\Clothes\Contract\ClothesInterface;
use Look\LookSelection\Domain\Event\Contract\EventInterface;
use Look\LookSelection\Domain\Look\Contract\LookInterface;
use Look\LookSelection\Domain\Look\Contract\SuitableCalculatorStrategyInterface;
use Look\LookSelection\Domain\User\Contract\UserInterface;
use Look\LookSelection\Domain\Weather\Contract\WeatherInterface;

class Look implements LookInterface
{
    /**
     * @param IdInterface $id
     * @param NameInterface $name
     * @param PhotoInterface $photo
     * @param SlugInterface $slug
     * @param WeatherInterface $weather
     * @param ClothesInterface[] $clothes
     * @param EventInterface[] $events
     */
    public function __construct(
        protected IdInterface      $id,
        protected NameInterface    $name,
        protected PhotoInterface   $photo,
        protected SlugInterface    $slug,
        protected WeatherInterface $weather,
        protected array            $clothes,
        protected array            $events
    ) {
    }

    public function getId(): IdInterface
    {
        return $this->id;
    }

    public function getName(): NameInterface
    {
        return $this->name;
    }

    public function getPhoto(): PhotoInterface
    {
        return $this->photo;
    }

    public function getSlug(): SlugInterface
    {
        return $this->slug;
    }

    public function getWeather(): WeatherInterface
    {
        return $this->weather;
    }

    public function getClothes(): array
    {
        return $this->clothes;
    }

    public function getEvents(): array
    {
        return $this->events;
    }

    public function getStyles(): array
    {
        $styles = [];

        foreach ($this->getClothes() as $clothes) {
            foreach ($clothes->getStyles() as $style) {
                if (!isset($styles[$style->getSlug()->getValue()])) {
                    $styles[$style->getSlug()->getValue()] = $style;
                }
            }
        }

        return array_values($styles);
    }

    public function getSuitableScore(
        SuitableCalculatorStrategyInterface $calculatorStrategy,
        UserInterface $user
    ): Percent {
        $suitableScore = $calculatorStrategy->execute($this, $user);

        if ($suitableScore > 100) {
            $suitableScore = 100;
        }

        return new Percent($suitableScore);
    }
}
