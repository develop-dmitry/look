<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Base\Visual\Button\ReplyButton\Option;

use Look\Common\Messenger\Base\Visual\Button\ReplyButton\Option\Enum\ReplyButtonOption;

class RequestLocationOption extends AbstractReplyButtonOption
{
    public function __construct(bool $value)
    {
        parent::__construct($value);
    }

    public function getName(): string
    {
        return ReplyButtonOption::RequestLocation->value;
    }
}
