<?php

declare(strict_types=1);

namespace Look\LookSelection\Application\PickLook\Contract;

use Look\LookSelection\Application\PickLook\DTO\PickLookRequest;
use Look\LookSelection\Application\PickLook\DTO\PickLookResponse;
use Look\LookSelection\Application\PickLook\Exception\PickLookFailedException;

interface PickLookInterface
{
    /**
     * @param PickLookRequest $request
     * @return PickLookResponse
     * @throws PickLookFailedException
     */
    public function execute(PickLookRequest $request): PickLookResponse;
}
