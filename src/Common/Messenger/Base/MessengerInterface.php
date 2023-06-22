<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Base;

interface MessengerInterface
{
    /**
     * @return void
     */
    public function run(): void;
}
