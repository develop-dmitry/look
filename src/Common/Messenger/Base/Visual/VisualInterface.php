<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Base\Visual;

use Look\Common\Messenger\Base\Visual\Keyboard\KeyboardInterface;

interface VisualInterface
{
    /**
     * @param KeyboardInterface $keyboard
     * @return void
     */
    public function setKeyboard(KeyboardInterface $keyboard): void;

    /**
     * @return KeyboardInterface|null
     */
    public function getKeyboard(): ?KeyboardInterface;

    /**
     * @param bool $isEditMessage
     * @return void
     */
    public function editMessage(bool $isEditMessage): void;

    /**
     * @return bool
     */
    public function isEditMessage(): bool;

    /**
     * @param string $message
     * @return void
     */
    public function setMessage(string $message): void;

    /**
     * @return string
     */
    public function getMessage(): string;
}
