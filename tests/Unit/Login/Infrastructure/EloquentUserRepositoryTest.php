<?php

declare(strict_types=1);

namespace Tests\Unit\Login\Infrastructure;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Look\Login\Domain\User\Exception\UserDoesNotExistsException;
use Look\Login\Infrastructure\Repository\EloquentUserRepository;
use Psr\Log\LoggerInterface;
use Tests\TestCase;

class EloquentUserRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    protected User $user;

    protected User $invalidUser;

    protected EloquentUserRepository $userRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::create([
            'name' => 'test',
            'email' => 'test@email.com',
            'password' => 'test',
            'telegram_token' => 1
        ]);

        $this->invalidUser = User::create([
            'name' => 'test2',
            'email' => 'test2@email.com',
            'password' => 'test2',
            'telegram_token' => -5
        ]);

        $this->userRepository = new EloquentUserRepository($this->app->make(LoggerInterface::class));
    }

    public function testGetUserWhenUserDoesNotExists(): void
    {
        $this->expectException(UserDoesNotExistsException::class);
        $this->userRepository->getUserByTelegramToken(2);
    }

    public function testGetUserWhenUserExists(): void
    {
        $user = $this->userRepository->getUserByTelegramToken($this->user->telegram_token);
        $this->assertEquals($this->user->id, $user->getId()->getValue());
    }

    public function testGetUserWhenInvalidUserData(): void
    {
        $this->expectException(UserDoesNotExistsException::class);
        $this->userRepository->getUserByTelegramToken($this->invalidUser->telegram_token);
    }
}
