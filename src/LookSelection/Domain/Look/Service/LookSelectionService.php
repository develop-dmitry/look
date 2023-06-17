<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Look\Service;

use Look\LookSelection\Domain\Event\Contract\Event;
use Look\LookSelection\Domain\Look\Contract\Look;
use Look\LookSelection\Domain\Look\Contract\LookRepository;
use Look\LookSelection\Domain\Look\Contract\LookSelectionService as LookSelectionServiceContract;
use Look\LookSelection\Domain\Look\Contract\SuitableCalculatorStrategy;
use Look\LookSelection\Domain\User\Contract\User;
use Look\LookSelection\Domain\Weather\Contract\Weather;

class LookSelectionService implements LookSelectionServiceContract
{
    public function __construct(
        protected LookRepository $lookRepository,
        protected SuitableCalculatorStrategy $calculatorStrategy
    ) {
    }

    public function pickLook(User $user, Event $event, Weather $weather): array
    {
        $looks = $this->lookRepository->findByEventAndWeather(
            $event->getSlug()->getValue(),
            $weather->getMinTemperature()->getValue(),
            $weather->getMaxTemperature()->getValue()
        );

        usort($looks, fn (Look $look) => $look->getSuitableScore($this->calculatorStrategy, $user)->getValue());

        return $looks;
    }
}
