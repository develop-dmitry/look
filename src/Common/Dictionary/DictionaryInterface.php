<?php

declare(strict_types=1);

namespace Look\Common\Dictionary;

interface DictionaryInterface
{
    /**
     * @param string $key
     * @param array $replace
     * @return string
     */
    public function getTranslate(string $key, array $replace = []): string;
}
