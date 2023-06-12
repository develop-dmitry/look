<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Look\Contract;

use Look\LookSelection\Domain\User\Contract\User;

interface SuitableCalculatorStrategy
{
    public function execute(Look $look, User $user): float;
}
