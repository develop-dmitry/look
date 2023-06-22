<?php

namespace Tests\Unit\Common\Messenger\Base\Visual\Button;

use Look\Common\Messenger\Base\Visual\Button\ButtonInterface;
use Tests\TestCase;

abstract class ButtonTestCase extends TestCase
{
    protected string $text = 'test';

    public function testButtonShouldReturnText(): void
    {
        $button = $this->makeButton($this->text);

        $this->assertEquals($this->text, $button->getText());
    }

    abstract protected function makeButton(string $text, array $options = []): ButtonInterface;
}
