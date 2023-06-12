<?php

declare(strict_types=1);

namespace Look\LookSelection\Infrastructure\Repository;

use Look\Common\Exception\InvalidValueException;
use Look\Common\Value\Id\Id;
use Look\Common\Value\Id\NullId;
use Look\Common\Value\Name\Name;
use Look\Common\Value\Slug\Slug;
use Look\LookSelection\Domain\Clothes\Contract\ClothesRepository;
use Look\LookSelection\Domain\Look\Value\Photo;
use Look\LookSelection\Domain\Style\Contract\StyleRepository;
use Psr\Log\LoggerInterface;
use Look\LookSelection\Domain\Clothes\Entity\Clothes;
use App\Models\Clothes as ClothesModel;

class EloquentClothesRepository implements ClothesRepository
{
    public function __construct(
        protected StyleRepository $styleRepository,
        protected LoggerInterface $logger
    ) {
    }

    public function findById(array $ids): array
    {
        $result = [];
        $clothes = ClothesModel::whereIn('id', $ids)->get();

        $clothes->each(function (ClothesModel $model) use (&$result) {
            try {
                $result[] = $this->makeEntity($model);
            } catch (InvalidValueException $exception) {
                $this->logger->error('Invalid clothes in database', [
                    'clothes' => $model->toArray(),
                    'exception' => $exception->getMessage()
                ]);
            }
        });

        return $result;
    }

    /**
     * @throws InvalidValueException
     */
    protected function makeEntity(ClothesModel $model): Clothes
    {
        return new Clothes(
            ($model->exists()) ? new Id($model->id) : new NullId(),
            new Name($model->name),
            new Slug($model->slug),
            new Photo($model->photo),
            $this->styleRepository->findById($model->styles()->pluck('id')->toArray())
        );
    }
}
