<?php

declare(strict_types=1);

namespace Tests\Unit\Common\Value;

use Look\Common\Exception\InvalidValueException;
use Look\Common\Value\Photo\Photo as PhotoEntity;
use Look\Common\Value\Photo\PhotoInterface;
use Tests\TestCase;

class PhotoTest extends TestCase
{
    protected string $stub = '';

    public function testEmptyPhotoShouldReturnImageStub(): void
    {
        $photo = $this->makePhoto('');

        $this->assertEquals($this->stub, $photo->getValue());
    }

    public function testPhotoShouldReturnImageUrl(): void
    {
        $photoUrl = 'https://test.com/image.png';
        $photo = $this->makePhoto($photoUrl);

        $this->assertEquals($photoUrl, $photo->getValue());
    }

    public function testPhotoImageExtension(): void
    {
        $this->expectException(InvalidValueException::class);
        $this->makePhoto('/test/image');
    }

    /**
     * @throws InvalidValueException
     */
    protected function makePhoto(string $value): PhotoInterface
    {
        return new PhotoEntity($value);
    }
}
