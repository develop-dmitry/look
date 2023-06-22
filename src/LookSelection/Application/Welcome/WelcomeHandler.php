<?php

declare(strict_types=1);

namespace Look\LookSelection\Application\Welcome;

use Look\Common\Messenger\Base\Context\ContextInterface;
use Look\Common\Messenger\Base\Handler\AbstractHandler;
use Look\Common\Messenger\Base\Visual\VisualInterface;

class WelcomeHandler extends AbstractHandler
{
    public function execute(ContextInterface $context, VisualInterface $visual): void
    {
        parent::execute($context, $visual);

        $visual->setMessage($this->dictionary->getTranslate('messenger.welcome_message'));
    }
}
