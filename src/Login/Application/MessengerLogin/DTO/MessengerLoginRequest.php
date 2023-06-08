<?php

declare(strict_types=1);

namespace Look\Login\Application\MessengerLogin\DTO;

class MessengerLoginRequest
{
    /**
     * @param int $token
     */
    public function __construct(
        protected int $token
    ) {
    }

    /**
     * @return int
     */
    public function getToken(): int
    {
        return $this->token;
    }

    /**
     * @param int $token
     */
    public function setToken(int $token): void
    {
        $this->token = $token;
    }
}
