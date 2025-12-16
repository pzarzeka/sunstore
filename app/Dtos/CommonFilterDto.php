<?php

declare(strict_types=1);

namespace App\Dtos;

use App\Enums\ProductCategory;

use Illuminate\Support\Collection;

final class CommonFilterDto
{
    /** @var ProductCategory[] */
    private array $categories;
    private Collection $manufacturers;
    private float $priceMin;
    private float $priceMax;

    public function __construct(
        array $categories,
        Collection $manufacturers,
        float $priceMin,
        float $priceMax
    ) {
        $this->categories = $categories;
        $this->manufacturers = $manufacturers;
        $this->priceMin = $priceMin;
        $this->priceMax = $priceMax;
    }

    public function getCategories(): array
    {
        return $this->categories;
    }

    public function getManufacturers(): Collection
    {
        return $this->manufacturers;
    }

    public function getPriceMin(): float
    {
        return $this->priceMin;
    }

    public function getPriceMax(): float
    {
        return $this->priceMax;
    }
}
