<?php

declare(strict_types=1);

namespace Tests\Unit\Auth\Infrastructure;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Look\Auth\Domain\User\Exception\UserDoesNotExistsException;
use Look\Auth\Domain\User\Exception\UserWasNotCreateException;
use Look\Auth\Domain\User\Value\TelegramToken;
use Look\Auth\Infrastructure\Repository\EloquentUserRepository;
use Psr\Log\LoggerInterface;
use Tests\TestCase;
use Look\Auth\Domain\User\Entity\User as UserEntity;

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

    public function testSetIdAfterCreateUser(): void
    {
        $user = new UserEntity(null, new TelegramToken(2));
        $this->userRepository->createUser($user);

        $this->assertNotNull($user->getId());
    }

    public function testCreateUser(): void
    {
        $user = new UserEntity(null, new TelegramToken(3));
        $this->userRepository->createUser($user);

        $this->assertNotNull(User::find($user->getId()->getValue()));
    }

    public function testCreateUserWhichTelegramTokenAlreadyExists(): void
    {
        $user = new UserEntity(null, new TelegramToken($this->user->telegram_token));

        $this->expectException(UserWasNotCreateException::class);
        $this->userRepository->createUser($user);
    }

    public function testExistenceUserWithTelegramTokenWhichExists(): void
    {
        $this->assertTrue($this->userRepository->isExistsUserWithTelegramToken($this->user->telegram_token));
    }

    public function testExistenceUserWithTelegramTokenWhichDoesNotExists(): void
    {
        $this->assertFalse($this->userRepository->isExistsUserWithTelegramToken(2));
    }
}
