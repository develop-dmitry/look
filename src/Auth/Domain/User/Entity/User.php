<?php

declare(strict_types=1);

namespace Look\Auth\Domain\User\Entity;

use Look\Auth\Domain\User\Contract\UserInterface;
use Look\Auth\Domain\User\Value\TelegramToken;
use Look\Common\Value\Id\Contract\Id;

class User implements UserInterface
{
    public function __construct(
        protected ?Id $id,
        protected ?TelegramToken $telegramToken
    ) {
    }

    public function getId(): ?Id
    {
        return $this->id;
    }

    public function getTelegramToken(): ?TelegramToken
    {
        return $this->telegramToken;
    }

    public function setId(Id $id): UserInterface
    {
        $this->id = $id;
        return $this;
    }
}
