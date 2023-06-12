<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\User\Contract;

use Look\Common\Value\Id\Contract\Id;
use Look\LookSelection\Domain\Style\Contract\Style;

interface User
{
    /**
     * @return Id
     */
    public function getId(): Id;

    /**
     * @return Style[]
     */
    public function getStyles(): array;
}
