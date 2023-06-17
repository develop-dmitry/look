<?php

declare(strict_types=1);

namespace Look\LookSelection\Infrastructure\Repository;

use App\Models\Look as LookModel;
use Illuminate\Database\Eloquent\Builder;
use Look\Common\Exception\InvalidValueException;
use Look\Common\Value\Id\Id;
use Look\Common\Value\Id\NullId;
use Look\Common\Value\Name\Name;
use Look\Common\Value\Slug\Slug;
use Look\LookSelection\Domain\Clothes\Contract\ClothesRepositoryInterface;
use Look\LookSelection\Domain\Event\Contract\EventRepositoryInterface;
use Look\LookSelection\Domain\Look\Contract\LookRepositoryInterface;
use Look\LookSelection\Domain\Look\Exception\LookNotFoundException;
use Look\LookSelection\Domain\Look\Look;
use Look\LookSelection\Domain\Look\Value\Photo;
use Look\LookSelection\Domain\Weather\Container\WeatherPeriod;
use Look\LookSelection\Domain\Weather\Value\Temperature;
use Look\LookSelection\Domain\Weather\Weather;
use Psr\Log\LoggerInterface;

class EloquentLookRepository implements LookRepositoryInterface
{
    public function __construct(
        protected EventRepositoryInterface   $eventRepository,
        protected ClothesRepositoryInterface $clothesRepository,
        protected LoggerInterface            $logger
    ) {
    }

    public function getBySlug(string $slug): Look
    {
        $look = LookModel::where('slug', $slug)->first();

        if (!$look) {
            throw new LookNotFoundException("Look with slug $slug not found");
        }

        try {
            return $this->makeEntity($look);
        } catch (InvalidValueException $exception) {
            $this->logger->error('Invalid look in database', [
                'look' => $look->toArray(),
                'exception' => $exception->getMessage()
            ]);

            throw new LookNotFoundException($exception->getMessage());
        }
    }

    public function findByEventAndWeather(string $eventSlug, float $minTemperature, float $maxTemperature): array
    {
        $result = [];

        $looks = LookModel::where('min_temperature', '>=', $minTemperature)
            ->where('max_temperature', '<=', $maxTemperature)
            ->whereHas('events', function (Builder $builder) use ($eventSlug) {
                $builder->where('slug', $eventSlug);
            })
            ->get();

        foreach ($looks as $look) {
            try {
                $result[] = $this->makeEntity($look);
            } catch (InvalidValueException $exception) {
                $this->logger->error('Invalid look in database', [
                    'look' => $look->toArray(),
                    'exception' => $exception->getMessage()
                ]);
            }
        }

        return $result;
    }

    /**
     * @throws InvalidValueException
     */
    protected function makeEntity(LookModel $model): Look
    {
        return new Look(
            ($model->exists()) ? new Id($model->id) : new NullId(),
            new Name($model->name),
            new Photo($model->photo),
            new Slug($model->slug),
            new Weather(
                new Temperature($model->min_temperature),
                new Temperature($model->max_temperature),
                new Temperature($model->average_temperature),
                WeatherPeriod::Morning,
                new \DateTime()
            ),
            $this->clothesRepository->findById($model->clothes()->pluck('id')->toArray()),
            $this->eventRepository->findById($model->events()->pluck('id')->toArray())
        );
    }
}
