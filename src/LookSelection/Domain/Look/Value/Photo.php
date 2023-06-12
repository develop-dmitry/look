<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Look\Value;

use Look\Common\Value\Photo\Photo as AbstractPhoto;

class Photo extends AbstractPhoto
{
    protected string $stub = '/storage/look-stub.jpg';
}
