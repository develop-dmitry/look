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
use Look\LookSelection\Domain\Style\Contract\Style;
use Look\LookSelection\Domain\User\Contract\User;
use Look\LookSelection\Domain\Weather\Contract\Weather;
use Look\Common\Value\Percent\Percent;

class Look implements LookContract
{
    protected array $suitableScoreWeight = [
        'clothes' => 7,
        'style' => 3
    ];

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

    public function getSuitableScore(User $user): Percent
    {
        $styleWeight = $this->suitableScoreWeight['style'] ?? 0;
        $clothesWeight = $this->suitableScoreWeight['clothes'] ?? 0;
        $totalWeight = $styleWeight + $clothesWeight;

        $styleScore = $this->calculateStyleSuitableScore($user) * $styleWeight / $totalWeight;
        $clothesScore = $this->calculateClothesSuitableScore($user) * $clothesWeight / $totalWeight;
        $totalScore = $styleScore + $clothesScore;

        try {
            return new Percent($totalScore);
        } catch (InvalidValueException) {
            return new Percent(0);
        }
    }

    protected function calculateStyleSuitableScore(User $user): float
    {
        $userStyles = array_map(static fn (Style $style) => $style->getSlug()->getValue(), $user->getStyles());
        $clothesStyles = [];

        foreach ($this->clothes as $clothes) {
            foreach ($clothes->getStyles() as $style) {
                $clothesStyles[] = $style->getSlug()->getValue();
            }
        }

        $clothesStyles = array_unique($clothesStyles);


        $suitableStyles = array_intersect($userStyles, $clothesStyles);

        return count($suitableStyles) / count($clothesStyles) * 100;
    }

    protected function calculateClothesSuitableScore(User $user): float
    {
        $userClothes = array_map(static fn (Clothes $clothes) => $clothes->getId()->getValue(), $user->getClothes());
        $lookClothes = array_map(static fn (Clothes $clothes) => $clothes->getId()->getValue(), $this->getClothes());
        $suitableClothes = array_intersect($userClothes, $lookClothes);

        return count($suitableClothes) / count($lookClothes) * 100;
    }
}
