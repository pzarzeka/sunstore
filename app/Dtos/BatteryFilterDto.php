<?php

declare(strict_types=1);

namespace App\Dtos;

class BatteryFilterDto
{
    private float $capacityMin;
    private float $capacityMax;

    public function __construct(float $capacityMin, float $capacityMax)
    {
        $this->capacityMin = $capacityMin;
        $this->capacityMax = $capacityMax;
    }

    public function getCapacityMin(): float
    {
        return $this->capacityMin;
    }

    public function getCapacityMax(): float
    {
        return $this->capacityMax;
    }
}
