<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Base\User;

use Look\Common\Messenger\Base\User\Contract\UserInterface;
use Look\Common\Value\Id\IdInterface;
use Look\Common\Value\MessengerToken\MessengerTokenInterface;

class User implements UserInterface
{
    protected bool $isChangedMessageHandler = false;

    public function __construct(
        protected IdInterface $id,
        protected MessengerTokenInterface $messengerToken,
        protected ?string $messageHandler = null
    ) {
    }

    public function getId(): IdInterface
    {
        return $this->id;
    }

    public function getMessageHandler(): ?string
    {
        return $this->messageHandler;
    }

    public function setMessageHandler(?string $messageHandler): void
    {
        $this->messageHandler = $messageHandler;
        $this->isChangedMessageHandler = true;
    }

    public function isChangedMessageHandler(): bool
    {
        return $this->isChangedMessageHandler;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId()->getValue(),
            'message_handler' => $this->getMessageHandler()
        ];
    }

    public function getMessengerToken(): MessengerTokenInterface
    {
        return $this->messengerToken;
    }
}
