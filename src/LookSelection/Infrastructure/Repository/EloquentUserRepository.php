<?php

declare(strict_types=1);

namespace Look\LookSelection\Infrastructure\Repository;

use Look\Common\Exception\InvalidValueException;
use Look\Common\Value\Id\Id;
use Look\Common\Value\Id\NullId;
use Look\LookSelection\Domain\Clothes\Contract\ClothesRepositoryInterface;
use Look\LookSelection\Domain\Style\Contract\StyleRepositoryInterface;
use Look\LookSelection\Domain\User\Contract\UserRepositoryInterface;
use Look\LookSelection\Domain\User\Exception\UserNotFoundException;
use Psr\Log\LoggerInterface;
use Look\LookSelection\Domain\User\User;
use App\Models\User as UserModel;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function __construct(
        protected StyleRepositoryInterface   $styleRepository,
        protected ClothesRepositoryInterface $clothesRepository,
        protected LoggerInterface            $logger
    ) {
    }

    public function getById(int $id): User
    {
        $user = UserModel::find($id);

        if (!$user) {
            throw new UserNotFoundException();
        }

        try {
            return $this->makeEntity($user);
        } catch (InvalidValueException $exception) {
            $this->logger->error('Invalid user in database', [
                'user' => $user->toArray(),
                'exception' => $exception->getMessage()
            ]);

            throw new UserNotFoundException($exception->getMessage());
        }
    }

    /**
     * @throws InvalidValueException
     */
    protected function makeEntity(UserModel $model): User
    {
        return new User(
            ($model->exists()) ? new Id($model->id) : new NullId(),
            $this->styleRepository->findById($model->styles()->pluck('id')->toArray()),
            $this->clothesRepository->findById($model->clothes()->pluck('id')->toArray())
        );
    }
}
