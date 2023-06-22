<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Base\Visual\Keyboard;

use Look\Common\Messenger\Base\Visual\Button\ButtonInterface;
use Look\Common\Messenger\Base\Visual\Option\Trait\HasOptions;

abstract class AbstractKeyboard implements KeyboardInterface
{
    use HasOptions;

    protected array $rows = [];

    public function addRow(ButtonInterface ...$button): static
    {
        $this->rows[] = $button;
        return $this;
    }

    public function getRows(): array
    {
        return $this->rows;
    }
}
