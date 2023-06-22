<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Base\Visual\Button;

use Look\Common\Messenger\Base\Visual\Option\Trait\HasOptions;

abstract class AbstractButton implements ButtonInterface
{
    use HasOptions;

    public function __construct(
        protected string $text
    ) {
    }

    public function getText(): string
    {
        return $this->text;
    }
}
