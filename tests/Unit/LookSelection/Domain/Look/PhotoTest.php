<?php

declare(strict_types=1);

namespace Tests\Unit\LookSelection\Domain\Look;

use Look\Common\Value\Photo\Contract\PhotoInterface;
use Tests\Unit\Common\Value\PhotoTest as CommonPhotoTest;
use Look\LookSelection\Domain\Look\Value\Photo as PhotoEntity;

class PhotoTest extends CommonPhotoTest
{
    protected string $stub = '/storage/look-stub.jpg';

    protected function makePhoto(string $value): PhotoInterface
    {
        return new PhotoEntity($value);
    }
}
