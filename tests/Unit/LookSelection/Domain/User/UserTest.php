<?php

declare(strict_types=1);

namespace Tests\Unit\LookSelection\Domain\User;

use Look\Common\Value\Id\Id;
use Look\Common\Value\Name\Name;
use Look\Common\Value\Slug\Slug;
use Look\LookSelection\Domain\Style\Style;
use Look\LookSelection\Domain\User\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    protected Id $id;

    protected array $styles;

    protected function setUp(): void
    {
        parent::setUp();

        $this->id = new Id(1);
        $this->styles = [new Style(new Name('Тест'), new Slug('test'))];
    }

    public function testUserShouldReturnId(): void
    {
        $user = new User($this->id, $this->styles);

        $this->assertEquals($this->id->getValue(), $user->getId()->getValue());
    }

    public function testUserShouldReturnStyles(): void
    {
        $user = new User($this->id, $this->styles);

        $this->assertCount(count($this->styles), $user->getStyles());
    }

    public function testUserWithoutStylesShouldReturnEmptyArray(): void
    {
        $user = new User($this->id, $this->styles);

        $this->assertNotEmpty($user->getStyles());
    }
}
