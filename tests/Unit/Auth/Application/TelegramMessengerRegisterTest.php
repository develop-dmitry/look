<?php

declare(strict_types=1);

namespace Tests\Unit\Auth\Application;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Look\Auth\Application\MessengerRegister\DTO\MessengerRegisterRequest;
use Look\Auth\Application\MessengerRegister\Exception\UserAlreadyExistsException;
use Look\Auth\Application\MessengerRegister\TelegramRegisterUseCase;
use Look\Auth\Domain\User\Contract\UserRepositoryInterface;
use Look\Auth\Infrastructure\Repository\EloquentUserRepository;
use Tests\TestCase;
use App\Models\User;

class TelegramMessengerRegisterTest extends TestCase
{
    use DatabaseTransactions;

    protected UserRepositoryInterface $userRepository;

    protected User $existsUser;

    protected function setUp(): void
    {
        parent::setUp();

        $this->existsUser = User::create(['telegram_token' => 1]);
        $this->userRepository = $this->app->make(EloquentUserRepository::class);
    }

    public function testRegisterWhenUserDoesNotExists(): void
    {
        $register = new TelegramRegisterUseCase($this->userRepository);

        $this->expectNotToPerformAssertions();
        $register->execute(new MessengerRegisterRequest(2));
    }

    public function testRegisterWhenUserWithThisTelegramTokenExists(): void
    {
        $register = new TelegramRegisterUseCase($this->userRepository);

        $this->expectException(UserAlreadyExistsException::class);
        $register->execute(new MessengerRegisterRequest(1));
    }
}
