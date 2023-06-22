<?php

declare(strict_types=1);

namespace Look\Common\Value\MessengerToken;

interface MessengerTokenInterface
{
    public function getValue(): string|int;
}
