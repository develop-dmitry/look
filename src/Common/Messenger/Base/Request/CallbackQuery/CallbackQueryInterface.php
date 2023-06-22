<?php

declare(strict_types=1);

namespace Look\Common\Messenger\Base\Request\CallbackQuery;

interface CallbackQueryInterface
{
    /**
     * @return string
     */
    public function getAction(): string;

    /**
     * @return array
     */
    public function getValues(): array;
}
