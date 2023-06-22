<?php

declare(strict_types=1);

namespace Tests\Unit\Common\Messenger\Base\Visual\Button;

use Look\Common\Messenger\Base\Visual\Button\ButtonInterface;
use Look\Common\Messenger\Base\Visual\Button\ReplyButton\Option\Enum\ReplyButtonOption;
use Look\Common\Messenger\Base\Visual\Button\ReplyButton\Option\RequestLocationOption;
use Look\Common\Messenger\Base\Visual\Button\ReplyButton\ReplyButton;

class ReplyButtonTest extends ButtonTestCase
{
    protected bool $buttonRequestLocation = true;

    public function testButtonShouldReturnOption(): void
    {
        $button = $this->makeButton($this->text, [new RequestLocationOption($this->buttonRequestLocation)]);

        $this->assertEquals(
            $this->buttonRequestLocation,
            $button->getOption(ReplyButtonOption::RequestLocation->value)->getValue()
        );
    }

    protected function makeButton(string $text, array $options = []): ButtonInterface
    {
        $button = new ReplyButton($text);

        foreach ($options as $option) {
            $button->addOption($option);
        }

        return $button;
    }
}
