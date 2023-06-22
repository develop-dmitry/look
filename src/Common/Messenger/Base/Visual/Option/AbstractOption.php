<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Base\Visual\Option;

use Look\Common\Messenger\Base\Visual\Option\Contract\OptionInterface;

abstract class AbstractOption implements OptionInterface
{
    protected string $name = '';

    public function __construct(
        protected mixed $value
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getValue(): mixed
    {
        return $this->value;
    }
}
