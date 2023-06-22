<?php

declare(strict_types=1);

namespace Tests\Unit\Common\Messenger\Base\Visual\Option;

use Look\Common\Messenger\Base\Visual\Option\Contract\OptionInterface;
use Tests\TestCase;

abstract class OptionTestCase extends TestCase
{
    protected string $name = '';

    protected mixed $defaultValue = '';

    public function testOptionShouldReturnName(): void
    {
        $option = $this->makeOption($this->defaultValue);

        $this->assertEquals($this->name, $option->getName());
    }

    public function testOptionShouldReturnValue(): void
    {
        $option = $this->makeOption($this->defaultValue);

        $this->assertEquals($this->defaultValue, $option->getValue());
    }

    abstract protected function makeOption(mixed $value): OptionInterface;
}
