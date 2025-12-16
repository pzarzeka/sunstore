<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder;

class SearchService
{
    /**
     * @param array $criteria
     * @return Product[]
     */
    public function search(array $criteria): array
    {
        $query = Product::query();

        if (false === empty($criteria['category'])) {
            $query->where('category', $criteria['category']);
        }

        if (false === empty($criteria['manufacturers'])) {
            $query->where('manufacturer', $criteria['manufacturers']);
        }

        if (false === empty($criteria['priceMin'])) {
            $query->where('price', '>=', $criteria['priceMin']);
        }

        if (false === empty($criteria['priceMax'])) {
            $query->where('price', '<=', $criteria['priceMax']);
        }

        if (false === empty($criteria['searchText'])) {
            $this->applyFullTextSearch($query, $criteria['searchText']);
        }

        if (false === empty($criteria['capacityMin'])) {
            $query->where('capacity', '>=', $criteria['capacityMin']);
        }

        if (false === empty($criteria['capacityMax'])) {
            $query->where('capacity', '<=', $criteria['capacityMax']);
        }

        if (false === empty($criteria['powerOutputMin'])) {
            $query->where('power_output', '>=', $criteria['powerOutputMin']);
        }

        if (false === empty($criteria['powerOutputMax'])) {
            $query->where('power_output', '<=', $criteria['powerOutputMax']);
        }

        if (false === empty($criteria['type'])) {
            $query->where('connector_type', $criteria['type']);
        }

        return $query->getModels();
    }

    private function applyFullTextSearch(Builder $query, string $search): void
    {
        $tokens = preg_split('/[\s\-]+/', $search);
        $booleanParts = [];
        foreach ($tokens as $token) {
            $token = trim($token);

            $token = rtrim($token, '*');
            if ($token === '') {
                continue;
            }

            $booleanParts[] = '+' . $token . '*';
        }
        if (empty($booleanParts)) {
            return;
        }

        $query->whereRaw(
            'MATCH(name, manufacturer, description) AGAINST (? IN BOOLEAN MODE)',
            [implode(' ', $booleanParts)]
        );
    }
}
