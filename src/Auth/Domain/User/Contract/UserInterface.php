<?php

declare(strict_types=1);

namespace Look\Auth\Domain\User\Contract;

use Look\Auth\Domain\User\Value\TelegramToken;
use Look\Common\Value\Id\Contract\Id;

interface UserInterface
{
    /**
     * @param Id $id
     * @return self
     */
    public function setId(Id $id): self;

    /**
     * @return Id|null
     */
    public function getId(): ?Id;

    /**
     * @return TelegramToken|null
     */
    public function getTelegramToken(): ?TelegramToken;
}
