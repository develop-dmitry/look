<?php

declare(strict_types=1);

namespace Tests\Unit\Common\Messenger\Base\Request;

use Look\Common\Messenger\Base\Request\CallbackQuery\CallbackQuery;
use Tests\TestCase;

class CallbackQueryTest extends TestCase
{
    public function testCallbackQueryShouldReturnAction(): void
    {
        $callbackQuery = CallbackQuery::fromJson(json_encode(['action' => 'test']));

        $this->assertEquals('test', $callbackQuery->getAction());
    }

    public function testCallbackQueryShouldReturnValues(): void
    {
        $values = ['test' => 'test', 'test1' => 'test2'];
        $callbackQuery = CallbackQuery::fromJson(json_encode($values));

        $this->assertNotEmpty($callbackQuery->getValues());

        foreach ($callbackQuery->getValues() as $key => $value) {
            $this->assertEquals($values[$key], $value);
        }
    }

    public function testCallbackQueryShouldReturnEmptyActionIfThisDoesNotExists(): void
    {
        $callbackQuery = CallbackQuery::createEmpty();

        $this->assertEquals('', $callbackQuery->getAction());
    }

    public function testCallbackQueryShouldReturnEmptyValuesIfThisDoesNotExists(): void
    {
        $callbackQuery = CallbackQuery::createEmpty();

        $this->assertEmpty($callbackQuery->getValues());
    }
}
