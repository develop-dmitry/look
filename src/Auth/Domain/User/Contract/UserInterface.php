<?php

declare(strict_types=1);

namespace Look\Auth\Domain\User\Contract;

use Look\Auth\Domain\User\Value\TelegramToken;
use Look\Common\Value\Id\Contract\IdInterface;

interface UserInterface
{
    /**
     * @param IdInterface $id
     * @return self
     */
    public function setId(IdInterface $id): self;

    /**
     * @return IdInterface|null
     */
    public function getId(): ?IdInterface;

    /**
     * @return TelegramToken|null
     */
    public function getTelegramToken(): ?TelegramToken;
}
