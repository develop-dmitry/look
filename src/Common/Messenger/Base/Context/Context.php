<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Base\Context;

use Look\Common\Messenger\Base\Context\Exception\UserDoesNotAuthException;
use Look\Common\Messenger\Base\Request\RequestInterface;
use Look\Common\Messenger\Base\User\Contract\UserInterface;

class Context implements ContextInterface
{
    public function __construct(
        protected RequestInterface $request,
        protected ?UserInterface $user
    ) {
    }

    public function getRequest(): RequestInterface
    {
        return $this->request;
    }

    public function getUser(): UserInterface
    {
        if (!$this->isUserAuth()) {
            throw new UserDoesNotAuthException();
        }

        return $this->user;
    }

    public function isUserAuth(): bool
    {
        return !is_null($this->user);
    }
}
