<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Base\Context;

use Look\Common\Messenger\Base\Context\Exception\UserDoesNotAuthException;
use Look\Common\Messenger\Base\Request\RequestInterface;
use Look\Common\Messenger\Base\User\Contract\UserInterface;

interface ContextInterface
{
    /**
     * @return RequestInterface
     */
    public function getRequest(): RequestInterface;

    /**
     * @return UserInterface
     * @throws UserDoesNotAuthException
     */
    public function getUser(): UserInterface;

    /**
     * @return bool
     */
    public function isUserAuth(): bool;
}
