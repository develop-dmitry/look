<?php

declare(strict_types=1);

namespace Tests\Unit\Common\Messenger\Base\Visual\Option;

use Look\Common\Messenger\Base\Visual\Button\ReplyButton\Option\RequestLocationOption;
use Look\Common\Messenger\Base\Visual\Option\Contract\OptionInterface;

class RequestLocationOptionTest extends OptionTestCase
{
    protected string $name = 'request_location';

    protected mixed $defaultValue = true;

    public function testOptionReturnFalse(): void
    {
        $option = $this->makeOption(false);

        $this->assertFalse($option->getValue());
    }

    protected function makeOption(mixed $value): OptionInterface
    {
        return new RequestLocationOption($value);
    }
}
