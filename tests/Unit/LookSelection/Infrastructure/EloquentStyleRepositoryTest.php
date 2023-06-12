<?php

declare(strict_types=1);

namespace Tests\Unit\LookSelection\Infrastructure;

use App\Models\Style;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Look\LookSelection\Infrastructure\Repository\EloquentStyleRepository;
use Psr\Log\LoggerInterface;
use Tests\TestCase;

class EloquentStyleRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    public function testFindingExistsEvents(): void
    {
        $events = Style::inRandomOrder()->limit(3);
        $styleRepository = new EloquentStyleRepository($this->app->make(LoggerInterface::class));

        $events = $styleRepository->findById($events->pluck('id')->toArray());

        $this->assertNotEmpty($events);
    }

    public function testFindingNotExistsEvents(): void
    {
        $latestStyle = Style::latest('id')->first();
        $styleRepository = new EloquentStyleRepository($this->app->make(LoggerInterface::class));

        $styles = $styleRepository->findById([$latestStyle->id + 1, $latestStyle->id + 2]);

        $this->assertEmpty($styles);
    }
}
