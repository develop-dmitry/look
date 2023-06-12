<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Look\Entity;

use Look\Common\Value\Id\Contract\Id;
use Look\Common\Value\Name\Contract\Name;
use Look\Common\Value\Photo\Contract\Photo;
use Look\Common\Value\Slug\Contract\Slug;
use Look\LookSelection\Domain\Clothes\Contract\Clothes;
use Look\LookSelection\Domain\Event\Contract\Event;
use Look\LookSelection\Domain\Look\Contract\Look as LookContract;
use Look\LookSelection\Domain\Weather\Contract\Weather;

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
}
