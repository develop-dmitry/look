<?php

declare(strict_types=1);

namespace Tests\Unit\Common\Messenger\Base\Visual\Option;

use Look\Common\Messenger\Base\Visual\Option\Contract\OptionInterface;
use Look\Common\Messenger\Base\Visual\Option\NullOption;

class NullOptionTest extends OptionTestCase
{
    protected string $name = 'test';

    protected function makeOption(mixed $value): OptionInterface
    {
        return new NullOption($this->name);
    }
}
