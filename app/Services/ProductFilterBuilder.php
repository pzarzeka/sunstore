<?php

declare(strict_types=1);

namespace App\Services;

use App\Dtos\BatteryFilterDto;
use App\Dtos\CommonFilterDto;
use App\Dtos\ConnectorFilterDto;
use App\Dtos\FilterDto;
use App\Dtos\SolarPanelFilterDto;
use App\Enums\ProductCategory;
use App\Models\Product;

class ProductFilterBuilder
{
    public function getFilters(): FilterDto
    {
        return new FilterDto(
            $this->getCommonFilters(),
            $this->getBatteryFilters(),
            $this->getSolarPanelFilters(),
            $this->getConnectorFilters()
        );
    }

    private function getCommonFilters(): CommonFilterDto
    {
        return new CommonFilterDto(
            ProductCategory::cases(),
            Product::query()
                ->select('manufacturer')
                ->distinct()
                ->orderBy('manufacturer')
                ->pluck('manufacturer'),
            (float) Product::min('price') ?? 0,
            (float) Product::max('price') ?? 0
        );
    }

    private function getBatteryFilters(): BatteryFilterDto
    {
        return new BatteryFilterDto(
            (float) Product::where('category', ProductCategory::Battery)->min('capacity') ?? 0,
            (float) Product::where('category', ProductCategory::Battery)->max('capacity') ?? 0
        );
    }

    private function getSolarPanelFilters(): SolarPanelFilterDto
    {
        return new SolarPanelFilterDto(
            (int) Product::where('category', ProductCategory::SolarPanel)->min('power_output') ?? 0,
            (int) Product::where('category', ProductCategory::SolarPanel)->max('power_output') ?? 0
        );
    }

    private function getConnectorFilters(): ConnectorFilterDto
    {
        return new ConnectorFilterDto(
            Product::where('category', ProductCategory::Connector)
                ->select('connector_type')
                ->distinct()
                ->orderBy('connector_type')
                ->pluck('connector_type')
        );
    }
}
