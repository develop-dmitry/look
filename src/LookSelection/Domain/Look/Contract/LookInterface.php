<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Look\Contract;

use Look\Common\Value\Id\Contract\Id;
use Look\Common\Value\Name\Contract\Name;
use Look\Common\Value\Percent\Contact\Percent;
use Look\Common\Value\Photo\Contract\Photo;
use Look\Common\Value\Slug\Contract\Slug;
use Look\LookSelection\Domain\Clothes\Contract\ClothesInterface;
use Look\LookSelection\Domain\Event\Contract\EventInterface;
use Look\LookSelection\Domain\Style\Contract\StyleInterface;
use Look\LookSelection\Domain\User\Contract\UserInterface;
use Look\LookSelection\Domain\Weather\Contract\WeatherInterface;

interface LookInterface
{
    /**
     * @return Id
     */
    public function getId(): Id;

    /**
     * @return Name
     */
    public function getName(): Name;

    /**
     * @return Photo
     */
    public function getPhoto(): Photo;

    /**
     * @return Slug
     */
    public function getSlug(): Slug;

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
     * @return Percent
     */
    public function getSuitableScore(SuitableCalculatorStrategyInterface $calculatorStrategy, UserInterface $user): Percent;
}
