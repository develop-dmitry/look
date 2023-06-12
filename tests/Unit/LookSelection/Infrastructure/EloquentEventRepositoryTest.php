<?php

declare(strict_types=1);

namespace Tests\Unit\LookSelection\Infrastructure;

use App\Models\Event;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Look\LookSelection\Infrastructure\Repository\EloquentEventRepository;
use Psr\Log\LoggerInterface;
use Tests\TestCase;

class EloquentEventRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    public function testFindingExistsEvents(): void
    {
        $events = Event::inRandomOrder()->limit(3);
        $eventRepository = new EloquentEventRepository($this->app->make(LoggerInterface::class));

        $events = $eventRepository->findById($events->pluck('id')->toArray());

        $this->assertNotEmpty($events);
    }

    public function testFindingNotExistsEvents(): void
    {
        $latestEvent = Event::latest('id')->first();
        $eventRepository = new EloquentEventRepository($this->app->make(LoggerInterface::class));

        $events = $eventRepository->findById([$latestEvent->id + 1, $latestEvent->id + 2]);

        $this->assertEmpty($events);
    }
}
