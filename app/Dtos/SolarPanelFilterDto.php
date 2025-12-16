<?php

declare(strict_types=1);

namespace App\Dtos;

final class SolarPanelFilterDto
{
    private int $powerOutputMin;
    private int $powerOutputMax;

    public function __construct(int $powerOutputMin, int $powerOutputMax)
    {
        $this->powerOutputMin = $powerOutputMin;
        $this->powerOutputMax = $powerOutputMax;
    }

    public function getPowerOutputMin(): int
    {
        return $this->powerOutputMin;
    }

    public function getPowerOutputMax(): int
    {
        return $this->powerOutputMax;
    }
}
