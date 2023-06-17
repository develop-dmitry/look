<?php

declare(strict_types=1);

namespace Look\LookSelection\Infrastructure\Repository;

use App\Models\Event as EventModel;
use Look\Common\Exception\InvalidValueException;
use Look\Common\Value\Name\Name;
use Look\Common\Value\Slug\Slug;
use Look\LookSelection\Domain\Event\Contract\EventRepository;
use Look\LookSelection\Domain\Event\Event;
use Look\LookSelection\Domain\Event\Exception\EventNotFoundException;
use Psr\Log\LoggerInterface;

class EloquentEventRepository implements EventRepository
{
    public function __construct(
        protected LoggerInterface $logger
    ) {
    }

    public function findById(array $ids): array
    {
        $result = [];
        $events = EventModel::whereIn('id', $ids)->get();

        $events->each(function (EventModel $model) use (&$result) {
            try {
                $result[] = $this->makeEntity($model);
            } catch (InvalidValueException $exception) {
                $this->logger->error('Invalid event in database', [
                    'event' => $model->toArray(),
                    'exception' => $exception->getMessage()
                ]);
            }
        });

        return $result;
    }

    public function getById(int $id): Event
    {
        $model = EventModel::find($id);

        if (!$model) {
            throw new EventNotFoundException("Event with id $id not found");
        }

        try {
            return $this->makeEntity($model);
        } catch (InvalidValueException $exception) {
            $this->logger->error('Invalid event in database', [
                'event' => $model->toArray(),
                'exception' => $exception->getMessage()
            ]);

            throw new EventNotFoundException($exception->getMessage());
        }
    }

    /**
     * @throws InvalidValueException
     */
    protected function makeEntity(EventModel $model): Event
    {
        return new Event(
            new Name($model->name),
            new Slug($model->slug)
        );
    }
}
