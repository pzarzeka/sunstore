<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\ProductCategory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static \Illuminate\Database\Eloquent\Builder create(array $attributes = [])
 */
class Product extends Model
{
    protected $fillable = [
        'id',
        'name',
        'manufacturer',
        'price',
        'description',
        'category',
        'capacity',
        'power_output',
        'connector_type',
    ];

    protected $casts = [
        'category' => ProductCategory::class,
    ];
}
