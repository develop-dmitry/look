<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Base\Request;

use Look\Common\Messenger\Base\Request\CallbackQuery\CallbackQueryInterface;
use Look\Common\Messenger\Base\Request\Geolocation\GeolocationInterface;

class Request implements RequestInterface
{
    public function __construct(
        protected string $message,
        protected CallbackQueryInterface $callbackQuery,
        protected ?GeolocationInterface $geolocation
    ) {
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getCallbackQuery(): CallbackQueryInterface
    {
        return $this->callbackQuery;
    }

    public function getGeolocation(): ?GeolocationInterface
    {
        return $this->geolocation;
    }
}
