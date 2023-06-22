<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Base\Handler\HandlerContainer;

use Look\Common\Messenger\Base\Handler\Enum\HandlerType;
use Look\Common\Messenger\Base\Handler\Exception\HandlerDoesNotExistsException;
use Look\Common\Messenger\Base\Handler\HandlerInterface;

class HandlerContainer implements HandlerContainerInterface
{
    protected array $items = [];

    public function addCommandHandler(string $command, HandlerInterface $handler): HandlerContainerInterface
    {
        $this->items[HandlerType::Command->value][$command] = $handler;
        return $this;
    }

    public function addTextHandler(string $text, HandlerInterface $handler): HandlerContainerInterface
    {
        $this->items[HandlerType::Text->value][$text] = $handler;
        return $this;
    }

    public function addMessageHandler(string $slug, HandlerInterface $handler): HandlerContainerInterface
    {
        $this->items[HandlerType::Message->value][$slug] = $handler;
        return $this;
    }

    public function addCallbackQueryHandler(string $action, HandlerInterface $handler): HandlerContainerInterface
    {
        $this->items[HandlerType::CallbackQuery->value][$action] = $handler;
        return $this;
    }

    public function getHandler(HandlerType $type, string $name): HandlerInterface
    {
        if (!$this->hasHandler($type, $name)) {
            throw new HandlerDoesNotExistsException();
        }

        return $this->items[$type->value][$name];
    }

    public function getHandlers(HandlerType $type): array
    {
        return $this->items[$type->value] ?? [];
    }

    public function hasHandler(HandlerType $type, string $name): bool
    {
        return isset($this->items[$type->value][$name]);
    }
}
