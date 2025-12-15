<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;

class SearchController
{
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function search(): View
    {
        return view('search');
    }

    public function searchResult(Request $request): Response
    {
        try {

        } catch (\Throwable $exception) {
            $this->logger->error($exception->getMessage());

            return redirect()
                ->route('search')
                ->with('success', 'Search with error: something went wrong.');
        }

        return redirect()
            ->route('search-result');
    }
}
