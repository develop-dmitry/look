<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Base\Visual\Option\Contract;

interface OptionalInterface
{
    /**
     * @param string $name
     * @return OptionInterface
     */
    public function getOption(string $name): OptionInterface;
}
