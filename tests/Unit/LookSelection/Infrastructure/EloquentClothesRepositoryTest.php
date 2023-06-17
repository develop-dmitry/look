<?php

declare(strict_types=1);

namespace Tests\Unit\LookSelection\Infrastructure;

use App\Models\Clothes;
use App\Models\Style;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Look\LookSelection\Infrastructure\Repository\EloquentClothesRepository;
use Look\LookSelection\Infrastructure\Repository\EloquentStyleRepository;
use Psr\Log\LoggerInterface;
use Tests\TestCase;

class EloquentClothesRepositoryTest extends TestCase
{
    use DatabaseTransactions;

    public function testFindingExistsEvents(): void
    {
        $events = Clothes::inRandomOrder()->limit(3);
        $clothesRepository = new EloquentClothesRepository(
            $this->app->make(EloquentStyleRepository::class),
            $this->app->make(LoggerInterface::class)
        );

        $events = $clothesRepository->findById($events->pluck('id')->toArray());

        $this->assertNotEmpty($events);
    }

    public function testFindingNotExistsEvents(): void
    {
        $latestClothes = Clothes::latest('id')->first();
        $clothesRepository = new EloquentClothesRepository(
            $this->app->make(EloquentStyleRepository::class),
            $this->app->make(LoggerInterface::class)
        );

        $clothes = $clothesRepository->findById([$latestClothes->id + 1, $latestClothes->id + 2]);

        $this->assertEmpty($clothes);
    }

    public function testClothesReturnCorrectStyle(): void
    {
        $styleModel = Style::inRandomOrder()->first();
        $clothesModel = Clothes::create(['name' => 'test', 'slug' => 'test', 'photo' => 'https://test.com/image.png']);
        $clothesModel->styles()->attach($styleModel);

        $clothesRepository = new EloquentClothesRepository(
            $this->app->make(EloquentStyleRepository::class),
            $this->app->make(LoggerInterface::class)
        );
        $clothes = $clothesRepository->findById([$clothesModel->id]);
        $styles = $clothes[0]->getStyles();

        $this->assertNotEmpty($styles);
        $this->assertEquals($styleModel->slug, $styles[0]->getSlug()->getValue());
    }
}
