<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Look;

use Look\Common\Exception\InvalidValueException;
use Look\Common\Value\Id\Contract\Id;
use Look\Common\Value\Name\Contract\Name;
use Look\Common\Value\Photo\Contract\Photo;
use Look\Common\Value\Slug\Contract\Slug;
use Look\LookSelection\Domain\Clothes\Contract\Clothes;
use Look\LookSelection\Domain\Event\Contract\Event;
use Look\LookSelection\Domain\Look\Contract\Look as LookContract;
use Look\LookSelection\Domain\Look\Contract\SuitableCalculatorStrategy;
use Look\LookSelection\Domain\User\Contract\User;
use Look\LookSelection\Domain\Weather\Contract\Weather;
use Look\Common\Value\Percent\Percent;

class Look implements LookContract
{
    /**
     * @param Id $id
     * @param Name $name
     * @param Photo $photo
     * @param Slug $slug
     * @param Weather $weather
     * @param Clothes[] $clothes
     * @param Event[] $events
     */
    public function __construct(
        protected Id $id,
        protected Name $name,
        protected Photo $photo,
        protected Slug $slug,
        protected Weather $weather,
        protected array $clothes,
        protected array $events
    ) {
    }

    public function getId(): Id
    {
        return $this->id;
    }

    public function getName(): Name
    {
        return $this->name;
    }

    public function getPhoto(): Photo
    {
        return $this->photo;
    }

    public function getSlug(): Slug
    {
        return $this->slug;
    }

    public function getWeather(): Weather
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

    public function getSuitableScore(SuitableCalculatorStrategy $calculatorStrategy, User $user): Percent
    {
        $suitableScore = $calculatorStrategy->execute($this, $user);

        if ($suitableScore > 100) {
            $suitableScore = 100;
        }

        try {
            return new Percent($suitableScore);
        } catch (InvalidValueException) {
            return new Percent(0);
        }
    }
}
