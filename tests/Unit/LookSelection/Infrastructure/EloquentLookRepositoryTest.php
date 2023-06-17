<?php

declare(strict_types=1);

namespace Tests\Unit\LookSelection\Infrastructure;

use App\Models\Clothes;
use App\Models\Event;
use App\Models\Look;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Look\LookSelection\Domain\Look\Exception\LookNotFoundException;
use Look\LookSelection\Infrastructure\Repository\EloquentLookRepository;
use Tests\TestCase;

class EloquentLookRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    public function testGettingExistsLook(): void
    {
        $look = Look::first();
        $lookRepository = $this->app->make(EloquentLookRepository::class);

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

        $lookRepository = $this->app->make(EloquentLookRepository::class);

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

        $lookRepository = $this->app->make(EloquentLookRepository::class);
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

        $lookRepository = $this->app->make(EloquentLookRepository::class);
        $look = $lookRepository->getBySlug($lookModel->slug);
        $events = $look->getEvents();

        $this->assertNotEmpty($events);
        $this->assertEquals($eventModel->slug, $events[0]->getSlug()->getValue());
    }

    public function testFindingByEventAndWeather(): void
    {
        $lookModel = Look::whereHas('events')
            ->whereNotNull('min_temperature')
            ->whereNotNull('max_temperature')
            ->whereNotNull('average_temperature')
            ->first();

        if (!$lookModel) {
            $this->markTestSkipped('Look not found');
        }

        $lookRepository = $this->app->make(EloquentLookRepository::class);

        $looks = $lookRepository->findByEventAndWeather(
            $lookModel->events()->first()->slug,
            $lookModel->min_temperature,
            $lookModel->max_temperature
        );

        $looks = array_map(static fn ($look) => $look->getId()->getValue(), $looks);

        $this->assertNotEmpty($looks);
        $this->assertContains($lookModel->id, $looks);
    }
}
