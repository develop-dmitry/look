<?php

declare(strict_types=1);

namespace Tests\Unit\Common\Messenger\Base\Visual\Option;

use Look\Common\Messenger\Base\Visual\Button\InlineButton\Option\CallbackDataOption;
use Look\Common\Messenger\Base\Visual\Option\Contract\OptionInterface;

class CallbackDataOptionTest extends OptionTestCase
{
    protected string $name = 'callback_data';

    protected mixed $defaultValue = ['test' => 'test'];

    protected string $action = 'test';

    public function testOptionShouldReturnValue(): void
    {
        $option = $this->makeOption($this->defaultValue);
        $value = $this->defaultValue;
        $value['action'] = $this->action;

        $this->assertEquals(json_encode($value), $option->getValue());
    }


    protected function makeOption(mixed $value): OptionInterface
    {
        return new CallbackDataOption($this->action, $value);
    }
}
