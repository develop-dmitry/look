<?php

declare(strict_types=1);

namespace Tests\Unit\Common\Value;

use Look\Common\Value\Id\NullId;
use Tests\TestCase;

class NullIdTest extends TestCase
{
    public function testNullIdShouldSayingThatHeIsNull(): void
    {
        $id = new NullId();

        $this->assertTrue($id->isNull());
    }

    public function testNullIdShouldReturnZero(): void
    {
        $id = new NullId();

        $this->assertEquals(0, $id->getValue());
    }
}
