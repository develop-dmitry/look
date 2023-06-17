<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Look\Contract;

use Look\Common\Value\Id\Contract\IdInterface;
use Look\Common\Value\Name\Contract\NameInterface;
use Look\Common\Value\Percent\Contact\PercentInterface;
use Look\Common\Value\Photo\Contract\PhotoInterface;
use Look\Common\Value\Slug\Contract\SlugInterface;
use Look\LookSelection\Domain\Clothes\Contract\ClothesInterface;
use Look\LookSelection\Domain\Event\Contract\EventInterface;
use Look\LookSelection\Domain\Style\Contract\StyleInterface;
use Look\LookSelection\Domain\User\Contract\UserInterface;
use Look\LookSelection\Domain\Weather\Contract\WeatherInterface;

interface LookInterface
{
    /**
     * @return IdInterface
     */
    public function getId(): IdInterface;

    /**
     * @return NameInterface
     */
    public function getName(): NameInterface;

    /**
     * @return PhotoInterface
     */
    public function getPhoto(): PhotoInterface;

    /**
     * @return SlugInterface
     */
    public function getSlug(): SlugInterface;

    /**
     * @return WeatherInterface
     */
    public function getWeather(): WeatherInterface;

    /**
     * @return ClothesInterface[]
     */
    public function getClothes(): array;

    /**
     * @return EventInterface[]
     */
    public function getEvents(): array;

    /**
     * @return StyleInterface[]
     */
    public function getStyles(): array;

    /**
     * @param SuitableCalculatorStrategyInterface $calculatorStrategy
     * @param UserInterface $user
     * @return PercentInterface
     */
    public function getSuitableScore(SuitableCalculatorStrategyInterface $calculatorStrategy, UserInterface $user): PercentInterface;
}
