<?php

declare(strict_types=1);

namespace Look\Auth\Application\MessengerLogin\DTO;

class MessengerLoginResponse
{
    /**
     * @param int $userId
     */
    public function __construct(
        protected int $userId
    ) {
    }

    /**
     * @return int
     */
    public function getUserId(): int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }
}
