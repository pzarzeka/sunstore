<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\ProductCategory;
use Exception;
use App\Factory\ProductFactory;
use App\Repository\ProductRepository;

class ProductImportService
{
    private ProductRepository $productRepository;
    private ProductFactory $productFactory;

    public function __construct(ProductRepository $productRepository, ProductFactory $productFactory)
    {
        $this->productRepository = $productRepository;
        $this->productFactory = $productFactory;
    }

    public function import(string $category, string $path): void
    {
        $rows = array_map('str_getcsv', file($path));
        $header = array_shift($rows);

        if (true === empty($header)) {
            throw new Exception('asd1');
        }

        if (null === $header) {
            throw new Exception('asd2');
        }

        foreach ($rows as $row) {
            $data = array_combine($header, $row);

            $product = $this->productFactory->createFromArray([
                'id' => $data['id'],
                'name' => $data['name'],
                'manufacturer' => $data['manufacturer'],
                'price' => $data['price'],
                'description' => $data['description'] ?? null,
                'category' => $category,
                'capacity' => $category === ProductCategory::Battery->value ? (int) $data['capacity'] : null,
                'power_output' => $category === ProductCategory::SolarPanel->value ? (int) $data['power_output'] : null,
                'connector_type' => $category === ProductCategory::Connector->value ? $data['connector_type'] : null,
            ]);
            $this->productRepository->save($product);
        }
    }
}
