<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Base\Handler;

use Look\Common\Dictionary\DictionaryInterface;
use Look\Common\Messenger\Base\Context\ContextInterface;
use Look\Common\Messenger\Base\Visual\VisualInterface;

abstract class AbstractHandler implements HandlerInterface
{
    protected VisualInterface $visual;

    protected ContextInterface $context;

    public function __construct(
        protected DictionaryInterface $dictionary
    ) {
    }

    public function execute(ContextInterface $context, VisualInterface $visual): void
    {
        $this->visual = $visual;
        $this->context = $context;
    }
}
