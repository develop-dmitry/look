<?php

declare(strict_types=1);

namespace Tests\Unit\Common\Messenger\Base\Visual\Option;

use Look\Common\Messenger\Base\Visual\Button\InlineButton\Option\UrlOption;
use Look\Common\Messenger\Base\Visual\Option\Contract\OptionInterface;

class UrlOptionTest extends OptionTestCase
{
    protected string $name = 'url';

    protected mixed $defaultValue = 'https://test.com';

    protected function makeOption(mixed $value): OptionInterface
    {
        return new UrlOption($value);
    }
}
