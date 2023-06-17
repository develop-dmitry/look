<?php

declare(strict_types=1);

namespace Tests\Unit\LookSelection\Application;

use Look\Common\Value\Id\Id;
use Look\Common\Value\Name\Name;
use Look\Common\Value\Photo\Photo;
use Look\Common\Value\Slug\Slug;
use Look\LookSelection\Application\PickLook\DTO\PickLookRequest;
use Look\LookSelection\Application\PickLook\PickLookUseCase;
use Look\LookSelection\Domain\Clothes\Clothes;
use Look\LookSelection\Domain\Event\Contract\EventRepositoryInterface;
use Look\LookSelection\Domain\Event\Event;
use Look\LookSelection\Domain\Look\Contract\LookSelectionServiceInterface;
use Look\LookSelection\Domain\Look\Look;
use Look\LookSelection\Domain\User\Contract\UserRepositoryInterface;
use Look\LookSelection\Domain\User\User;
use Look\LookSelection\Domain\Weather\Container\WeatherPeriod;
use Look\LookSelection\Domain\Weather\Entity\Weather;
use Look\LookSelection\Domain\Weather\Value\Temperature;
use Psr\Log\LoggerInterface;
use Tests\TestCase;

class PickLookTest extends TestCase
{
    protected array $looks;

    protected User $user;

    protected Event $event;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = new User(new Id(1), [], []);
        $this->event = new Event(new Name('test'), new Slug('test'));

        $weatherOne = new Weather(
            new Temperature(-10),
            new Temperature(10),
            new Temperature(0),
            WeatherPeriod::Morning,
            new \DateTime()
        );
        $weatherTwo = new Weather(
            new Temperature(0),
            new Temperature(15),
            new Temperature(7),
            WeatherPeriod::Evening,
            new \DateTime()
        );

        $clothesOne = new Clothes(
            new Id(1),
            new Name('Test 1'),
            new Slug('test-one'),
            new Photo('https://test.com/test.png'),
            []
        );
        $clothesTwo = new Clothes(
            new Id(2),
            new Name('Test 2'),
            new Slug('test-two'),
            new Photo('https://test.com/test.png'),
            []
        );

        $eventOne = new Event(new Name('Test 1'), new Slug('test-one'));
        $eventTwo = new Event(new Name('Test 2'), new Slug('test-two'));

        $this->looks = [
            new Look(
                new Id(1),
                new Name('Test 1'),
                new Photo('https://test.com/test.png'),
                new Slug('test-one'),
                $weatherOne,
                [$clothesOne, $clothesTwo],
                [$eventOne]
            ),
            new Look(
                new Id(2),
                new Name('Test 2'),
                new Photo('https://test.com/test.png'),
                new Slug('test-two'),
                $weatherTwo,
                [$clothesOne],
                [$eventOne, $eventTwo]
            )
        ];
    }

    public function testPickLookResponseIsEmpty(): void
    {
        $userRepository = $this->getMockBuilder(UserRepositoryInterface::class)->getMock();
        $userRepository->method('getById')->willReturn($this->user);
        $eventRepository = $this->getMockBuilder(EventRepositoryInterface::class)->getMock();
        $eventRepository->method('getById')->willReturn($this->event);
        $lookSelection = $this->getMockBuilder(LookSelectionServiceInterface::class)->getMock();
        $lookSelection->method('pickLook')->willReturn([]);

        $pickLook = new PickLookUseCase(
            $lookSelection,
            $userRepository,
            $eventRepository,
            $this->app->make(LoggerInterface::class)
        );

        $looks = $pickLook->execute(new PickLookRequest(1, 1, -10, -10));

        $this->assertEmpty($looks->getLooks());
    }

    public function testPickLookResponseNotEmpty(): void
    {
        $userRepository = $this->getMockBuilder(UserRepositoryInterface::class)->getMock();
        $userRepository->method('getById')->willReturn($this->user);
        $eventRepository = $this->getMockBuilder(EventRepositoryInterface::class)->getMock();
        $eventRepository->method('getById')->willReturn($this->event);
        $lookSelection = $this->getMockBuilder(LookSelectionServiceInterface::class)->getMock();
        $lookSelection->method('pickLook')->willReturn($this->looks);

        $pickLook = new PickLookUseCase(
            $lookSelection,
            $userRepository,
            $eventRepository,
            $this->app->make(LoggerInterface::class)
        );

        $looks = $pickLook->execute(new PickLookRequest(1, 1, -10, -10));

        $this->assertNotEmpty($looks->getLooks());
    }

    public function testPickLookResponseArrayStructure(): void
    {
        $userRepository = $this->getMockBuilder(UserRepositoryInterface::class)->getMock();
        $userRepository->method('getById')->willReturn($this->user);
        $eventRepository = $this->getMockBuilder(EventRepositoryInterface::class)->getMock();
        $eventRepository->method('getById')->willReturn($this->event);
        $lookSelection = $this->getMockBuilder(LookSelectionServiceInterface::class)->getMock();
        $lookSelection->method('pickLook')->willReturn($this->looks);

        $pickLook = new PickLookUseCase(
            $lookSelection,
            $userRepository,
            $eventRepository,
            $this->app->make(LoggerInterface::class)
        );

        $looks = $pickLook->execute(new PickLookRequest(1, 1, -10, -10));

        foreach ($looks->getLooks() as $look) {
            $this->assertArrayHasKey('id', $look);
            $this->assertArrayHasKey('name', $look);
            $this->assertArrayHasKey('slug', $look);
            $this->assertArrayHasKey('photo', $look);
            $this->assertArrayHasKey('events', $look);
            $this->assertArrayHasKey('clothes', $look);
        }
    }
}
