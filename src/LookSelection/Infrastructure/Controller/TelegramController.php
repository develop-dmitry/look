<?php

declare(strict_types=1);

namespace Look\LookSelection\Infrastructure\Controller;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Look\Auth\Application\MessengerLogin\Contract\MessengerLoginInterface;
use Look\Auth\Application\MessengerRegister\Contract\MessengerRegisterInterface;
use Look\Common\Dictionary\DictionaryInterface;
use Look\Common\Messenger\Base\Handler\HandlerContainer\HandlerContainer;
use Look\Common\Messenger\Base\Handler\HandlerContainer\HandlerContainerInterface;
use Look\Common\Messenger\Base\User\Contract\UserRepositoryInterface;
use Look\Common\Messenger\Base\Visual\VisualInterface;
use Look\Common\Messenger\Telegram\TelegramMessenger;
use Look\LookSelection\Application\Welcome\WelcomeHandler;
use Psr\Log\LoggerInterface;
use SergiX44\Nutgram\Nutgram;

class TelegramController extends Controller
{
    protected TelegramMessenger $messenger;

    protected HandlerContainerInterface $handlers;

    public function __construct(
        protected Application $app,
        protected LoggerInterface $logger,
        protected DictionaryInterface $dictionary,
    ) {
        $this->handlers = new HandlerContainer();
        $this->messenger = $this->app->makeWith(TelegramMessenger::class, ['handlers' => $this->handlers]);
    }

    public function __invoke(Request $request): void
    {
        $this->logger->debug('Telegram request', $request->toArray());

        $this->initHandlers();
        $this->messenger->run();
    }

    protected function initHandlers(): void
    {
        $this->handlers->addCommandHandler('start', $this->app->make(WelcomeHandler::class));
    }
}
