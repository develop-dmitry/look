<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Base\Visual\Option\Trait;

use Look\Common\Messenger\Base\Visual\Option\Contract\OptionInterface;
use Look\Common\Messenger\Base\Visual\Option\NullOption;

trait HasOptions
{
    /**
     * @var OptionInterface[]
     */
    protected array $options = [];

    public function getOption(string $name): OptionInterface
    {
        if ($this->hasOption($name)) {
            return $this->options[$name];
        }

        return $this->getNullOption($name);
    }

    protected function hasOption(string $name): bool
    {
        return isset($this->options[$name]);
    }

    protected function getNullOption(string $name): OptionInterface
    {
        return new NullOption($name);
    }
}
