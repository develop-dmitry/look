<?php

declare(strict_types=1);

namespace Tests\Unit\Common\Messenger\Base\Visual\Button;

use Look\Common\Messenger\Base\Visual\Button\ButtonInterface;
use Look\Common\Messenger\Base\Visual\Button\InlineButton\InlineButton;
use Look\Common\Messenger\Base\Visual\Button\InlineButton\Option\Enum\InlineButtonOption;
use Look\Common\Messenger\Base\Visual\Button\InlineButton\Option\UrlOption;

class InlineButtonTest extends ButtonTestCase
{
    protected string $buttonUrl = 'https://test.ru';

    public function testButtonShouldReturnOption(): void
    {
        $button = $this->makeButton($this->text, [new UrlOption($this->buttonUrl)]);

        $this->assertEquals($this->buttonUrl, $button->getOption(InlineButtonOption::Url->value)->getValue());
    }

    protected function makeButton(string $text, array $options = []): ButtonInterface
    {
        $button = new InlineButton($text);

        foreach ($options as $option) {
            $button->addOption($option);
        }

        return $button;
    }
}
