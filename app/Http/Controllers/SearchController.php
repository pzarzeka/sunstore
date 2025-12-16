<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Services\ProductFilterBuilder;
use App\Services\SearchService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;

class SearchController
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function search(
        Request $request,
        ProductFilterBuilder $productFilterBuilder,
        SearchService $searchService
    ): View {
        $filter = $productFilterBuilder->getFilters();
        try {
            $products = [];
            if ($request->has('search')) {
                $products = $searchService->search($request->all());
            }
        } catch (\Throwable $exception) {
            $this->logger->error($exception->getMessage());

            return view('search', [
                'filter' => $filter,
            ])
            ->with('error', 'Search with error: something went wrong.');
        }

        return view('search', [
            'filter' => $filter,
            'products' => $products,
        ]);
    }
}
