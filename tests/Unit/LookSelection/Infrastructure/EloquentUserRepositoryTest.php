<?php

declare(strict_types=1);

namespace Tests\Unit\LookSelection\Infrastructure;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Look\LookSelection\Domain\User\Exception\UserNotFoundException;
use Look\LookSelection\Infrastructure\Repository\EloquentStyleRepository;
use Look\LookSelection\Infrastructure\Repository\EloquentUserRepository;
use Psr\Log\LoggerInterface;
use Tests\TestCase;

class EloquentUserRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    public function testGettingByIdExistsUser(): void
    {
        $userModel = User::first();

        if (!$userModel) {
            $this->markTestSkipped('Users table is empty');
        }

        $userRepository = new EloquentUserRepository(
            $this->app->make(EloquentStyleRepository::class),
            $this->app->make(LoggerInterface::class)
        );
        $user = $userRepository->getById($userModel->id);

        $this->assertEquals($userModel->id, $user->getId()->getValue());
    }

    public function testGettingByIdNotExistsUser(): void
    {
        $userModel = User::latest('id')->first();

        $userRepository = new EloquentUserRepository(
            $this->app->make(EloquentStyleRepository::class),
            $this->app->make(LoggerInterface::class)
        );

        $this->expectException(UserNotFoundException::class);
        $userRepository->getById(($userModel) ? $userModel->id + 1 : 1);
    }
}
