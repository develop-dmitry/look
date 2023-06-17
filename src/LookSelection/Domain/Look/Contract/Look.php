<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Look\Contract;

use Look\Common\Value\Id\Contract\Id;
use Look\Common\Value\Name\Contract\Name;
use Look\Common\Value\Percent\Contact\Percent;
use Look\Common\Value\Photo\Contract\Photo;
use Look\Common\Value\Slug\Contract\Slug;
use Look\LookSelection\Domain\Clothes\Contract\Clothes;
use Look\LookSelection\Domain\Event\Contract\Event;
use Look\LookSelection\Domain\Style\Contract\Style;
use Look\LookSelection\Domain\User\Contract\User;
use Look\LookSelection\Domain\Weather\Contract\Weather;

interface Look
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
     * @return Weather
     */
    public function getWeather(): Weather;

    /**
     * @return Clothes[]
     */
    public function getClothes(): array;

    /**
     * @return Event[]
     */
    public function getEvents(): array;

    /**
     * @return Style[]
     */
    public function getStyles(): array;

    /**
     * @param SuitableCalculatorStrategy $calculatorStrategy
     * @param User $user
     * @return Percent
     */
    public function getSuitableScore(SuitableCalculatorStrategy $calculatorStrategy, User $user): Percent;
}
