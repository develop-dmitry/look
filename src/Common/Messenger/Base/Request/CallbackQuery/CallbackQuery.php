<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Base\Request\CallbackQuery;

class CallbackQuery implements CallbackQueryInterface
{
    protected function __construct(
        protected string $action,
        protected array $values
    ) {
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getValues(): array
    {
        return $this->values;
    }

    public static function fromJson(string $json): CallbackQueryInterface
    {
        $data = json_decode($json, true);
        $action = $data['action'] ?? '';

        unset($data['action']);

        return new self($action, $data);
    }

    public static function createEmpty(): CallbackQueryInterface
    {
        return new self('', []);
    }
}
