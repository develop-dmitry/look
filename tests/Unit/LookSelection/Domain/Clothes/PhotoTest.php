<?php

declare(strict_types=1);

namespace Tests\Unit\LookSelection\Domain\Clothes;

use Look\Common\Exception\InvalidValueException;
use Look\LookSelection\Domain\Clothes\Value\Photo;
use Tests\TestCase;

class PhotoTest extends TestCase
{
    protected string $stub = '/storage/stub.jpg';

    public function testEmptyPhotoShouldReturnImageStub(): void
    {
        $photo = new Photo('');

        $this->assertEquals($this->stub, $photo->getValue());
    }

    public function testPhotoShouldReturnImageUrl(): void
    {
        $photo = new Photo('/test/image.png');

        $this->assertEquals('/test/image.png', $photo->getValue());
    }

    public function testPhotoImageExtension(): void
    {
        $this->expectException(InvalidValueException::class);
        new Photo('/test/image');
    }
}
