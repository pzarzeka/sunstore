<?php

declare(strict_types=1);

namespace App\Factory;

use App\Models\Product;

class ProductFactory
{
    public function createFromArray(array $data): Product
    {
        return Product::create($data);
    }
}
