<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Base\Handler;

use Look\Common\Messenger\Base\Context\ContextInterface;
use Look\Common\Messenger\Base\Visual\VisualInterface;

interface HandlerInterface
{
    /**
     * @param ContextInterface $context
     * @param VisualInterface $visual
     * @return void
     */
    public function execute(ContextInterface $context, VisualInterface $visual): void;
}
