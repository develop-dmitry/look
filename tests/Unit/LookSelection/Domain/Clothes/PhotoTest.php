<?php

declare(strict_types=1);

namespace Tests\Unit\LookSelection\Domain\Clothes;

use Look\Common\Value\Photo\PhotoInterface;
use Look\LookSelection\Domain\Clothes\Value\Photo as PhotoEntity;
use Tests\Unit\Common\Value\PhotoTest as CommonPhotoTest;

class PhotoTest extends CommonPhotoTest
{
    protected string $stub = '/storage/stub.jpg';

    protected function makePhoto(string $value): PhotoInterface
    {
        return new PhotoEntity($value);
    }
}
