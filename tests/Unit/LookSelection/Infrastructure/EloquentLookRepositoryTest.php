<?php

declare(strict_types=1);

namespace Tests\Unit\LookSelection\Infrastructure;

use App\Models\Clothes;
use App\Models\Event;
use App\Models\Look;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Look\LookSelection\Domain\Look\Exception\LookNotFoundException;
use Look\LookSelection\Infrastructure\Repository\EloquentClothesRepository;
use Look\LookSelection\Infrastructure\Repository\EloquentEventRepository;
use Look\LookSelection\Infrastructure\Repository\EloquentLookRepository;
use Psr\Log\LoggerInterface;
use Tests\TestCase;

class EloquentLookRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    public function testGettingExistsLook(): void
    {
        $look = Look::first();
        $lookRepository = new EloquentLookRepository(
            $this->app->make(EloquentEventRepository::class),
            $this->app->make(EloquentClothesRepository::class),
            $this->app->make(LoggerInterface::class)
        );

        $lookEntity = $lookRepository->getBySlug($look->slug);

        $this->assertEquals($look->id, $lookEntity->getId()->getValue());
    }

    public function testGettingNotExistsLook(): void
    {
        $slug = 'test123132';
        $isExistLook = Look::where('slug', $slug)->first();

        if ($isExistLook) {
            $this->markTestSkipped("Look with slug $slug exists in database");
        }

        $lookRepository = new EloquentLookRepository(
            $this->app->make(EloquentEventRepository::class),
            $this->app->make(EloquentClothesRepository::class),
            $this->app->make(LoggerInterface::class)
        );

        $this->expectException(LookNotFoundException::class);
        $lookRepository->getBySlug($slug);
    }

    public function testLookReturnCorrectClothes(): void
    {
        $clothesModel = Clothes::inRandomOrder()->first();
        $lookModel = Look::create([
            'name' => 'Тест',
            'slug' => 'testing-correct-return-clothes',
            'photo' => 'https://test.com/image.png',
            'min_temperature' =>  10,
            'max_temperature' => 30,
            'average_temperature' => 15
        ]);
        $lookModel->clothes()->attach($clothesModel);

        $lookRepository = new EloquentLookRepository(
            $this->app->make(EloquentEventRepository::class),
            $this->app->make(EloquentClothesRepository::class),
            $this->app->make(LoggerInterface::class)
        );
        $look = $lookRepository->getBySlug($lookModel->slug);
        $clothes = $look->getClothes();

        $this->assertNotEmpty($clothes);
        $this->assertEquals($clothesModel->id, $clothes[0]->getId()->getValue());
    }

    public function testLookReturnCorrectEvent(): void
    {
        $eventModel = Event::inRandomOrder()->first();
        $lookModel = Look::create([
            'name' => 'Тест',
            'slug' => 'testing-correct-return-clothes',
            'photo' => 'https://test.com/image.png',
            'min_temperature' =>  10,
            'max_temperature' => 30,
            'average_temperature' => 15
        ]);
        $lookModel->events()->attach($eventModel);

        $lookRepository = new EloquentLookRepository(
            $this->app->make(EloquentEventRepository::class),
            $this->app->make(EloquentClothesRepository::class),
            $this->app->make(LoggerInterface::class)
        );
        $look = $lookRepository->getBySlug($lookModel->slug);
        $events = $look->getEvents();

        $this->assertNotEmpty($events);
        $this->assertEquals($eventModel->slug, $events[0]->getSlug()->getValue());
    }
}
