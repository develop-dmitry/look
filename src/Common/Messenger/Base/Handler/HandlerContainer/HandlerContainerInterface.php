<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Base\Handler\HandlerContainer;

use Look\Common\Messenger\Base\Handler\Enum\HandlerType;
use Look\Common\Messenger\Base\Handler\Exception\HandlerDoesNotExistsException;
use Look\Common\Messenger\Base\Handler\HandlerInterface;

interface HandlerContainerInterface
{
    /**
     * @param string $command
     * @param HandlerInterface $handler
     * @return self
     */
    public function addCommandHandler(string $command, HandlerInterface $handler): self;

    /**
     * @param string $text
     * @param HandlerInterface $handler
     * @return self
     */
    public function addTextHandler(string $text, HandlerInterface $handler): self;

    /**
     * @param string $slug
     * @param HandlerInterface $handler
     * @return self
     */
    public function addMessageHandler(string $slug, HandlerInterface $handler): self;

    /**
     * @param string $action
     * @param HandlerInterface $handler
     * @return self
     */
    public function addCallbackQueryHandler(string $action, HandlerInterface $handler): self;

    /**
     * @param HandlerType $type
     * @param string $name
     * @return HandlerInterface
     * @throws HandlerDoesNotExistsException
     */
    public function getHandler(HandlerType $type, string $name): HandlerInterface;

    /**
     * @param HandlerType $type
     * @return HandlerInterface[]
     */
    public function getHandlers(HandlerType $type): array;

    /**
     * @param HandlerType $type
     * @param string $name
     * @return bool
     */
    public function hasHandler(HandlerType $type, string $name): bool;
}
