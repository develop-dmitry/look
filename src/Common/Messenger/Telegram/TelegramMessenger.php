<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Telegram;

use Look\Auth\Application\MessengerLogin\Contract\MessengerLoginInterface;
use Look\Auth\Application\MessengerRegister\Contract\MessengerRegisterInterface;
use Look\Common\Dictionary\DictionaryInterface;
use Look\Common\Messenger\Base\AbstractMessenger;
use Look\Common\Messenger\Base\Context\Context;
use Look\Common\Messenger\Base\Handler\Enum\HandlerType;
use Look\Common\Messenger\Base\Handler\HandlerContainer\HandlerContainerInterface;
use Look\Common\Messenger\Base\Request\CallbackQuery\CallbackQuery;
use Look\Common\Messenger\Base\Request\Geolocation\Geolocation;
use Look\Common\Messenger\Base\Request\Request;
use Look\Common\Messenger\Base\Request\RequestInterface;
use Look\Common\Messenger\Base\User\Contract\UserInterface;
use Look\Common\Messenger\Base\User\Contract\UserRepositoryInterface;
use Look\Common\Messenger\Base\User\User;
use Look\Common\Messenger\Base\Visual\Button\ButtonInterface;
use Look\Common\Messenger\Base\Visual\Keyboard\InlineKeyboard\InlineKeyboard;
use Look\Common\Messenger\Base\Visual\Keyboard\KeyboardInterface;
use Look\Common\Messenger\Base\Visual\Keyboard\KeyboardType;
use Look\Common\Messenger\Base\Visual\VisualInterface;
use Look\Common\Messenger\Telegram\Value\TelegramToken;
use Look\Common\Value\Id\Id;
use Psr\Log\LoggerInterface;
use SergiX44\Nutgram\Nutgram;
use SergiX44\Nutgram\RunningMode\Webhook;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardButton;
use SergiX44\Nutgram\Telegram\Types\Keyboard\InlineKeyboardMarkup;
use SergiX44\Nutgram\Telegram\Types\Keyboard\KeyboardButton;
use SergiX44\Nutgram\Telegram\Types\Keyboard\ReplyKeyboardMarkup;
use SergiX44\Nutgram\Telegram\Types\Message\Message;

class TelegramMessenger extends AbstractMessenger
{
    public function __construct(
        protected Nutgram $bot,
        protected VisualInterface $visual,
        HandlerContainerInterface $handlers,
        LoggerInterface $logger,
        MessengerLoginInterface $messengerLogin,
        MessengerRegisterInterface $messengerRegister,
        DictionaryInterface $dictionary,
        UserRepositoryInterface $userRepository
    ) {
        parent::__construct(
            $userRepository,
            $handlers,
            $messengerLogin,
            $messengerRegister,
            $logger,
            $dictionary
        );
    }


    public function run(): void
    {
        $this->bot->setRunningMode(Webhook::class);

        foreach ($this->handlers->getHandlers(HandlerType::Command) as $command => $handler) {
            $this->bot->onCommand($command, fn () => $this->executeHandler($handler));
        }

        foreach ($this->handlers->getHandlers(HandlerType::Text) as $text => $handler) {
            $this->bot->onText($text, fn () => $this->executeHandler($handler));
        }

        $this->bot->onCallbackQuery(fn () => $this->executeHandler([$this, 'getCallbackQueryHandler']));

        $this->bot->onMessage(fn () => $this->executeHandler([$this, 'getMessageHandler']));

        $this->bot->run();
    }

    protected function makeResponse(): Message|bool|null
    {
        $message = $this->visual->getMessage();
        $keyboard = $this->getKeyboard();

        if ($this->visual->isEditMessage()) {
            return $this->bot->editMessageText($message, reply_markup: $keyboard);
        }

        return $this->bot->sendMessage($message, reply_markup: $keyboard);
    }

    protected function makeUser(int $userId, int|string $messengerToken): ?UserInterface
    {
        return new User(
            new Id($userId),
            new TelegramToken($messengerToken)
        );
    }

    protected function initContext(): void
    {
        $user = null;

        if ($this->bot->userId()) {
            $user = $this->getUser($this->bot->userId());
        }

        $this->context = new Context($this->getRequest(), $user);
    }

    protected function getRequest(): RequestInterface
    {
        $message = '';
        $geolocation = null;

        if ($this->bot->message()) {
            $message = $this->bot->message()->getText();
            $location = $this->bot->message()->location;

            if ($location) {
                $geolocation = new Geolocation($location->latitude, $location->longitude);
            }
        }

        if ($this->bot->callbackQuery()) {
            $callbackQuery = CallbackQuery::fromJson($this->bot->callbackQuery()->data);
        } else {
            $callbackQuery = CallbackQuery::createEmpty();
        }

        return new Request($message, $callbackQuery, $geolocation);
    }

    protected function getKeyboard(): ReplyKeyboardMarkup|InlineKeyboard|null
    {
        $keyboard = $this->visual->getKeyboard();

        if (is_null($keyboard)) {
            return null;
        }

        return match ($keyboard->getKeyboardType()) {
            KeyboardType::Reply => $this->getReplyKeyboard($keyboard),
            KeyboardType::Inline => $this->getInlineKeyboard($keyboard)
        };
    }

    protected function getReplyKeyboard(KeyboardInterface $keyboard): ReplyKeyboardMarkup
    {
        $replyKeyboard = new ReplyKeyboardMarkup(
            $keyboard->getOption('resize_keyboard')->getValue(),
            $keyboard->getOption('one_time_keyboard')->getValue(),
            $keyboard->getOption('input_field_placeholder')->getValue(),
            $keyboard->getOption('selective')->getValue(),
            $keyboard->getOption('is_persistent')->getValue()
        );

        foreach ($keyboard->getRows() as $row) {
            $buttons = array_map(fn ($button) => $this->getReplyButton($button), $row);
            $replyKeyboard->addRow(...$buttons);
        }

        return $replyKeyboard;
    }

    protected function getInlineKeyboard(KeyboardInterface $keyboard): InlineKeyboardMarkup
    {
        $inlineKeyboard = new InlineKeyboardMarkup();

        foreach ($keyboard->getRows() as $row) {
            $buttons = array_map(fn ($button) => $this->getInlineButton($button), $row);
            $inlineKeyboard->addRow(...$buttons);
        }

        return $inlineKeyboard;
    }

    protected function getReplyButton(ButtonInterface $button): KeyboardButton
    {
        return new KeyboardButton(
            $button->getText(),
            $button->getOption('request_contact')->getValue(),
            $button->getOption('request_location')->getValue(),
            $button->getOption('request_poll')->getValue(),
            $button->getOption('web_app')->getValue(),
            $button->getOption('request_user')->getValue(),
            $button->getOption('request_chat')->getValue(),
        );
    }

    protected function getInlineButton(ButtonInterface $button): InlineKeyboardButton
    {
        return new InlineKeyboardButton(
            $button->getText(),
            $button->getOption('url')->getValue(),
            $button->getOption('login_url')->getValue(),
            $button->getOption('callback_data')->getValue(),
            $button->getOption('switch_inline_query')->getValue(),
            $button->getOption('switch_inline_query_current_chat')->getValue(),
            $button->getOption('callback_game')->getValue(),
            $button->getOption('pay')->getValue(),
            $button->getOption('web_app')->getValue()
        );
    }
}
