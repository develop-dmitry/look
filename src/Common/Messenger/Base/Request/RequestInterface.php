<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Base\Request;

use Look\Common\Messenger\Base\Request\CallbackQuery\CallbackQueryInterface;
use Look\Common\Messenger\Base\Request\Geolocation\GeolocationInterface;

interface RequestInterface
{
    /**
     * @return string
     */
    public function getMessage(): string;

    /**
     * @return CallbackQueryInterface
     */
    public function getCallbackQuery(): CallbackQueryInterface;

    /**
     * @return GeolocationInterface|null
     */
    public function getGeolocation(): ?GeolocationInterface;
}
