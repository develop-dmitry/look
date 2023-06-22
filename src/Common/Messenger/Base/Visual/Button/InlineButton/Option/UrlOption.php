<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Base\Visual\Button\InlineButton\Option;

use Look\Common\Messenger\Base\Visual\Button\InlineButton\Option\Enum\InlineButtonOption;
use Look\Common\Messenger\Base\Visual\Option\AbstractOption;

class UrlOption extends AbstractInlineButtonOption
{
    public function __construct(string $value)
    {
        parent::__construct($value);
    }

    public function getName(): string
    {
        return InlineButtonOption::Url->value;
    }
}
