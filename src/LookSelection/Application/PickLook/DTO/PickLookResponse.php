<?php

declare(strict_types=1);

namespace Look\LookSelection\Application\PickLook\DTO;

class PickLookResponse
{
    public function __construct(
        protected array $looks
    ) {
    }

    /**
     * @return array
     */
    public function getLooks(): array
    {
        return $this->looks;
    }
}
