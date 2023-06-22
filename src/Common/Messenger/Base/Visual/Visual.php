<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Base\Visual;

use Look\Common\Messenger\Base\Visual\Keyboard\KeyboardInterface;

class Visual implements VisualInterface
{
    protected ?KeyboardInterface $keyboard = null;

    protected bool $isEditMessage = false;

    protected string $message = '';

    public function setKeyboard(KeyboardInterface $keyboard): void
    {
        $this->keyboard = $keyboard;
    }

    public function getKeyboard(): ?KeyboardInterface
    {
        return $this->keyboard;
    }

    public function editMessage(bool $isEditMessage): void
    {
        $this->isEditMessage = $isEditMessage;
    }

    public function isEditMessage(): bool
    {
        return $this->isEditMessage;
    }

    public function setMessage(string $message): void
    {
        $this->message = $message;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
