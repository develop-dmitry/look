<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Base\Visual\Button\InlineButton;

use Look\Common\Messenger\Base\Visual\Button\AbstractButton;
use Look\Common\Messenger\Base\Visual\Button\InlineButton\Option\AbstractInlineButtonOption;

class InlineButton extends AbstractButton
{
    public function addOption(AbstractInlineButtonOption $option): self
    {
        $this->options[$option->getName()] = $option;
        return $this;
    }
}
