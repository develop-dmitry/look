<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Base\User\Contract;

use Look\Common\Value\Id\IdInterface;
use Look\Common\Value\MessengerToken\MessengerTokenInterface;

interface UserInterface
{
    /**
     * @return MessengerTokenInterface
     */
    public function getMessengerToken(): MessengerTokenInterface;

    /**
     * @return IdInterface
     */
    public function getId(): IdInterface;

    /**
     * @return string|null
     */
    public function getMessageHandler(): ?string;

    /**
     * @param string|null $messageHandler
     * @return void
     */
    public function setMessageHandler(?string $messageHandler): void;

    /**
     * @return bool
     */
    public function isChangedMessageHandler(): bool;

    /**
     * @return array
     */
    public function toArray(): array;
}
