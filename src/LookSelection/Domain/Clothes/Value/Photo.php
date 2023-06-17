<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Clothes\Value;

use Look\Common\Value\Photo\Photo as AbstractPhoto;

class Photo extends AbstractPhoto
{
    protected string $stub = '/storage/stub.jpg';
}
