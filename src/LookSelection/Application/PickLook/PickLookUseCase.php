<?php

declare(strict_types=1);

namespace Look\LookSelection\Application\PickLook;

use Look\Common\Exception\InvalidValueException;
use Look\LookSelection\Application\PickLook\Contract\PickLookInterface;
use Look\LookSelection\Application\PickLook\DTO\PickLookRequest;
use Look\LookSelection\Application\PickLook\DTO\PickLookResponse;
use Look\LookSelection\Application\PickLook\Exception\PickLookFailedException;
use Look\LookSelection\Domain\Clothes\Contract\ClothesInterface;
use Look\LookSelection\Domain\Event\Contract\EventInterface;
use Look\LookSelection\Domain\Event\Contract\EventRepositoryInterface;
use Look\LookSelection\Domain\Event\Exception\EventNotFoundException;
use Look\LookSelection\Domain\Look\Contract\LookSelectionServiceInterface;
use Look\LookSelection\Domain\User\Contract\UserInterface;
use Look\LookSelection\Domain\User\Contract\UserRepositoryInterface;
use Look\LookSelection\Domain\User\Exception\UserNotFoundException;
use Look\LookSelection\Domain\Weather\Container\WeatherPeriod;
use Look\LookSelection\Domain\Weather\Entity\Weather;
use Look\LookSelection\Domain\Weather\Value\Temperature;
use Look\LookSelection\Domain\Weather\Contract\WeatherInterface as WeatherInterface;
use Psr\Log\LoggerInterface;

class PickLookUseCase implements PickLookInterface
{
    public function __construct(
        protected LookSelectionServiceInterface $lookSelectionService,
        protected UserRepositoryInterface       $userRepository,
        protected EventRepositoryInterface      $eventRepository,
        protected LoggerInterface               $logger
    ) {
    }

    public function execute(PickLookRequest $request): PickLookResponse
    {
        try {
            $user = $this->getUser($request->getUserId());
            $event = $this->getEvent($request->getEventId());
            $weather = $this->getWeather($request->getMinTemperature(), $request->getMaxTemperature());

            return new PickLookResponse($this->getLooks($user, $event, $weather));
        } catch (InvalidValueException|UserNotFoundException|EventNotFoundException $exception) {
            $this->logger->error('Не удалось подобрать образ', [
                'user_id' => $request->getUserId(),
                'event_id' => $request->getEventId(),
                'min_temperature' => $request->getMinTemperature(),
                'max_temperature' => $request->getMaxTemperature()
            ]);

            throw new PickLookFailedException($exception->getMessage());
        }
    }

    protected function getLooks(UserInterface $user, EventInterface $event, WeatherInterface $weather): array
    {
        $looks = $this->lookSelectionService->pickLook($user, $event, $weather);

        $result = [];

        foreach ($looks as $look) {
            $events = array_map(static fn (EventInterface $event) => $event->getSlug(), $look->getEvents());
            $clothes = array_map(static fn (ClothesInterface $clothes) => $clothes->getSlug(), $look->getClothes());

            $result[] = [
                'id' => $look->getId(),
                'name' => $look->getName(),
                'slug' => $look->getSlug(),
                'photo' => $look->getPhoto(),
                'events' => $events,
                'clothes' => $clothes
            ];
        }

        return $result;
    }

    /**
     * @throws UserNotFoundException
     */
    protected function getUser(int $userId): UserInterface
    {
        return $this->userRepository->getById($userId);
    }

    /**
     * @throws EventNotFoundException
     */
    protected function getEvent(int $eventId): EventInterface
    {
        return $this->eventRepository->getById($eventId);
    }

    /**
     * @throws InvalidValueException
     */
    protected function getWeather(float $minTemperature, float $maxTemperature): WeatherInterface
    {
        $average = ($minTemperature + $maxTemperature) / 2;

        return new Weather(
            new Temperature($minTemperature),
            new Temperature($maxTemperature),
            new Temperature($average),
            WeatherPeriod::Morning,
            new \DateTime()
        );
    }
}
