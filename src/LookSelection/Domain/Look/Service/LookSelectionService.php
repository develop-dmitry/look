<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Look\Service;

use Look\LookSelection\Domain\Event\Contract\EventInterface;
use Look\LookSelection\Domain\Look\Contract\LookInterface;
use Look\LookSelection\Domain\Look\Contract\LookRepositoryInterface;
use Look\LookSelection\Domain\Look\Contract\LookSelectionServiceInterface as LookSelectionServiceContract;
use Look\LookSelection\Domain\Look\Contract\SuitableCalculatorStrategyInterface;
use Look\LookSelection\Domain\User\Contract\UserInterface;
use Look\LookSelection\Domain\Weather\Contract\WeatherInterface;

class LookSelectionService implements LookSelectionServiceContract
{
    public function __construct(
        protected LookRepositoryInterface    $lookRepository,
        protected SuitableCalculatorStrategyInterface $calculatorStrategy
    ) {
    }

    public function pickLook(UserInterface $user, EventInterface $event, WeatherInterface $weather): array
    {
        $looks = $this->lookRepository->findByEventAndWeather(
            $event->getSlug()->getValue(),
            $weather->getMinTemperature()->getValue(),
            $weather->getMaxTemperature()->getValue()
        );

        usort($looks, fn (LookInterface $look) => $look->getSuitableScore($this->calculatorStrategy, $user)->getValue());

        return $looks;
    }
}
