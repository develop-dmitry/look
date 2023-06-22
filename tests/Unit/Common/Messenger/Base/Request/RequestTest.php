<?php

declare(strict_types=1);

namespace Tests\Unit\Common\Messenger\Base\Request;

use Look\Common\Messenger\Base\Request\CallbackQuery\CallbackQuery;
use Look\Common\Messenger\Base\Request\CallbackQuery\CallbackQueryInterface;
use Look\Common\Messenger\Base\Request\Geolocation\Geolocation;
use Look\Common\Messenger\Base\Request\Geolocation\GeolocationInterface;
use Look\Common\Messenger\Base\Request\Request;
use Tests\TestCase;

class RequestTest extends TestCase
{
    protected CallbackQueryInterface $callbackQuery;

    protected GeolocationInterface $geolocation;

    protected function setUp(): void
    {
        parent::setUp();

        $this->callbackQuery = CallbackQuery::fromJson(json_encode(['action' => 'test', 'value' => 'test']));
        $this->geolocation = new Geolocation(57, 53);
    }

    public function testRequestShouldReturnMessage(): void
    {
        $message = 'Тестовое сообщение';
        $request = new Request($message, $this->callbackQuery, $this->geolocation);

        $this->assertEquals($message, $request->getMessage());
    }

    public function testRequestShouldReturnCallbackQuery(): void
    {
        $request = new Request('Тест', $this->callbackQuery, $this->geolocation);

        $this->assertEquals($this->callbackQuery->getAction(), $request->getCallbackQuery()->getAction());
        $this->assertEquals($this->callbackQuery->getValues(), $request->getCallbackQuery()->getValues());
    }

    public function testRequestShouldReturnGeolocation(): void
    {
        $request = new Request('Тест', $this->callbackQuery, $this->geolocation);

        $this->assertEquals($this->geolocation->getLon(), $request->getGeolocation()->getLon());
        $this->assertEquals($this->geolocation->getLat(), $request->getGeolocation()->getLat());
    }
}
