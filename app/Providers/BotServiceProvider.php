<?php

namespace App\Providers;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Look\Auth\Application\MessengerLogin\Contract\MessengerLoginInterface;
use Look\Auth\Application\MessengerLogin\TelegramLoginUseCase;
use Look\Auth\Application\MessengerRegister\Contract\MessengerRegisterInterface;
use Look\Auth\Application\MessengerRegister\TelegramRegisterUseCase;
use Look\Common\Dictionary\DictionaryInterface;
use Look\Common\Messenger\Base\Handler\HandlerContainer\HandlerContainerInterface;
use Look\Common\Messenger\Base\User\Contract\UserRepositoryInterface;
use Look\Common\Messenger\Base\Visual\Visual;
use Look\Common\Messenger\Base\Visual\VisualInterface;
use Look\Common\Messenger\Telegram\Repository\TelegramUserRepository;
use Look\Common\Messenger\Telegram\TelegramMessenger;
use Psr\Log\LoggerInterface;
use SergiX44\Nutgram\Nutgram;

class BotServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(VisualInterface::class, Visual::class);

        $this->app->when(TelegramMessenger::class)
            ->needs(MessengerLoginInterface::class)
            ->give(TelegramLoginUseCase::class);

        $this->app->when(TelegramMessenger::class)
            ->needs(MessengerRegisterInterface::class)
            ->give(TelegramRegisterUseCase::class);

        $this->app->when(TelegramMessenger::class)
            ->needs(UserRepositoryInterface::class)
            ->give(TelegramUserRepository::class);

        $this->app->when(TelegramMessenger::class)
            ->needs(Nutgram::class)
            ->give(static fn() => new Nutgram(config('bot.telegram_token')));
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
