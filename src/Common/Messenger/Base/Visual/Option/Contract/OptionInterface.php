<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Base\Visual\Option\Contract;

interface OptionInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return mixed
     */
    public function getValue(): mixed;
}
