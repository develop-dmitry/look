<?php

declare(strict_types=1);

namespace Look\LookSelection\Infrastructure\Repository;

use Look\Common\Exception\InvalidValueException;
use Look\Common\Value\Name\Name;
use Look\Common\Value\Slug\Slug;
use Look\LookSelection\Domain\Style\Contract\StyleRepository;
use Psr\Log\LoggerInterface;
use Look\LookSelection\Domain\Style\Entity\Style;
use App\Models\Style as StyleModel;

class EloquentStyleRepository implements StyleRepository
{
    public function __construct(
        protected LoggerInterface $logger
    ) {
    }

    public function findById(array $ids): array
    {
        $result = [];
        $styles = StyleModel::whereIn('id', $ids)->get();

        $styles->each(function (StyleModel $model) use (&$result) {
            try {
                $result[] = $this->makeEntity($model);
            } catch (InvalidValueException $exception) {
                $this->logger->error('Invalid style in database', [
                    'style' => $model->toArray(),
                    'exception' => $exception->getMessage()
                ]);
            }
        });

        return $result;
    }

    /**
     * @throws InvalidValueException
     */
    protected function makeEntity(StyleModel $model): Style
    {
        return new Style(
            new Name($model->name),
            new Slug($model->slug)
        );
    }
}
