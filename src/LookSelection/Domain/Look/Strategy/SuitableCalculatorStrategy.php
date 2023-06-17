<?php

declare(strict_types=1);

namespace Look\LookSelection\Domain\Look\Strategy;

use Look\LookSelection\Domain\Clothes\Contract\ClothesInterface;
use Look\LookSelection\Domain\Look\Contract\LookInterface;
use Look\LookSelection\Domain\Look\Contract\SuitableCalculatorStrategyInterface as SuitableCalculatorStrategyContract;
use Look\LookSelection\Domain\Style\Contract\StyleInterface;
use Look\LookSelection\Domain\User\Contract\UserInterface;

class SuitableCalculatorStrategy implements SuitableCalculatorStrategyContract
{
    /**
     * @var array<string, int>
     */
    protected array $scoreWeights = [
        'clothes' => 7,
        'style' => 3
    ];

    protected LookInterface $look;

    protected UserInterface $user;

    public function execute(LookInterface $look, UserInterface $user): float
    {
        $this->user = $user;
        $this->look = $look;

        $scores = $this->getScores();

        return $this->getTotalScore($scores);
    }

    /**
     * @return array<string, int>
     */
    protected function getScores(): array
    {
        $scores = [];

        foreach ($this->getRules() as $key => $rule) {
            if (!is_callable($rule)) {
                continue;
            }

            $scores[$key] = $rule();
        }

        return $scores;
    }

    public function getTotalScore(array $scores): float
    {
        $totalWeight = array_sum($this->scoreWeights);
        $totalScore = 0;

        foreach ($this->scoreWeights as $key => $weight) {
            if (!isset($scores[$key])) {
                continue;
            }

            $totalScore += $scores[$key] * $weight / $totalWeight;
        }

        return $totalScore;
    }

    protected function calculateStyleScore(): float
    {
        $userStyles = array_map(static fn (StyleInterface $style) => $style->getSlug()->getValue(), $this->user->getStyles());
        $lookStyles = array_map(static fn (StyleInterface $style) => $style->getSlug()->getValue(), $this->look->getStyles());
        $suitableStyles = array_intersect($userStyles, $lookStyles);

        return count($suitableStyles) / count($lookStyles) * 100;
    }

    protected function calculateClothesScore(): float
    {
        $userClothesMapper = static fn (ClothesInterface $clothes) => $clothes->getId()->getValue();
        $lookClothesMapper = static fn (ClothesInterface $clothes) => $clothes->getId()->getValue();

        $userClothes = array_map($userClothesMapper, $this->user->getClothes());
        $lookClothes = array_map($lookClothesMapper, $this->look->getClothes());
        $suitableClothes = array_intersect($userClothes, $lookClothes);

        return count($suitableClothes) / count($lookClothes) * 100;
    }

    /**
     * @return array<string, callable>
     */
    protected function getRules(): array
    {
        return [
            'clothes' => [$this, 'calculateClothesScore'],
            'style' => [$this, 'calculateStyleScore']
        ];
    }
}
