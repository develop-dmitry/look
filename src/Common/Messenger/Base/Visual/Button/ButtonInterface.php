<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Base\Visual\Button;

use Look\Common\Messenger\Base\Visual\Option\Contract\OptionalInterface;

interface ButtonInterface extends OptionalInterface
{
    /**
     * @return string
     */
    public function getText(): string;
}
