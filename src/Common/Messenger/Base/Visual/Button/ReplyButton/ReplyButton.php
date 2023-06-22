<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Base\Visual\Button\ReplyButton;

use Look\Common\Messenger\Base\Visual\Button\AbstractButton;
use Look\Common\Messenger\Base\Visual\Button\ReplyButton\Option\AbstractReplyButtonOption;

class ReplyButton extends AbstractButton
{
    public function addOption(AbstractReplyButtonOption $option): self
    {
        $this->options[$option->getName()] = $option;
        return $this;
    }
}
