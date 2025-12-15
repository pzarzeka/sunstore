<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Enums\ProductCategory;
use App\Services\ProductImportService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Psr\Log\LoggerInterface;

class ImportController extends Controller
{
    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function import(): View
    {
        return view('import');
    }

    public function importSave(Request $request, ProductImportService $productImportService): RedirectResponse
    {
        try {
            $request->validate([
                'file' => 'required|file|mimes:csv,txt',
                'category' => ['required', Rule::in(ProductCategory::values())],
            ]);

            $productImportService->import(
                $request->get('category'),
                $request->file('file')->getRealPath()
            );
        } catch (\Throwable $exception) {
            $this->logger->error($exception->getMessage());

            return redirect()
                ->route('import')
                ->with('error', 'Import with error: ' . $exception->getMessage());
        }

        return redirect()
            ->route('import')
            ->with('success', 'Import successfully');
    }
}
