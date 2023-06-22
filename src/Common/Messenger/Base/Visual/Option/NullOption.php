<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Base\Visual\Option;

class NullOption extends AbstractOption
{
    public function __construct(string $name)
    {
        $this->name = $name;
        parent::__construct(null);
    }
}
