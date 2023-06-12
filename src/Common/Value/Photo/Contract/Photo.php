<?php

declare(strict_types=1);

namespace Look\Common\Value\Photo\Contract;

interface Photo
{
    /**
     * @return string
     */
    public function getValue(): string;
}
