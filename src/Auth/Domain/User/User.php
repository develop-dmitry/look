<?php

declare(strict_types=1);

namespace Look\Auth\Domain\User;

use Look\Auth\Domain\User\Contract\UserInterface;
use Look\Auth\Domain\User\Value\TelegramToken;
use Look\Common\Value\Id\IdInterface;

class User implements UserInterface
{
    public function __construct(
        protected ?IdInterface   $id,
        protected ?TelegramToken $telegramToken
    ) {
    }

    public function getId(): ?IdInterface
    {
        return $this->id;
    }

    public function getTelegramToken(): ?TelegramToken
    {
        return $this->telegramToken;
    }

    public function setId(IdInterface $id): UserInterface
    {
        $this->id = $id;
        return $this;
    }
}
