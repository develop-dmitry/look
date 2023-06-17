<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Look\Contract;

use Look\LookSelection\Domain\User\Contract\UserInterface;

interface SuitableCalculatorStrategyInterface
{
    public function execute(LookInterface $look, UserInterface $user): float;
}
