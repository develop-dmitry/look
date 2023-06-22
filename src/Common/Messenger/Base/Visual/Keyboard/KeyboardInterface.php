<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Base\Visual\Keyboard;

use Look\Common\Messenger\Base\Visual\Button\ButtonInterface;
use Look\Common\Messenger\Base\Visual\Option\Contract\OptionalInterface;

interface KeyboardInterface extends OptionalInterface
{
    /**
     * @param ButtonInterface ...$button
     * @return self
     */
    public function addRow(ButtonInterface ...$button): self;

    /**
     * @return ButtonInterface[][]
     */
    public function getRows(): array;

    /**
     * @return KeyboardType
     */
    public function getKeyboardType(): KeyboardType;
}
