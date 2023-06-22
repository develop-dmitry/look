<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Base\Visual\Button\InlineButton\Option;

use JsonException;
use Look\Common\Messenger\Base\Visual\Button\InlineButton\Option\Enum\InlineButtonOption;
use Look\Common\Messenger\Base\Visual\Option\AbstractOption;

class CallbackDataOption extends AbstractInlineButtonOption
{
    public function __construct(string $action, array $values = [])
    {
        $values['action'] = $action;

        parent::__construct($values);
    }

    public function getValue(): string
    {
        try {
            $json = json_encode($this->value, JSON_THROW_ON_ERROR);

            return $json ?: '';
        } catch (JsonException) {
            return '';
        }
    }

    public function getName(): string
    {
        return InlineButtonOption::CallbackData->value;
    }
}
