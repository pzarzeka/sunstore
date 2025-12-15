<?php

declare(strict_types=1);

namespace App\Repository;

use App\Models\Product;

final class ProductRepository
{
    public function save(Product $product): void
    {
        $product->save();
    }
}
