<?php

declare(strict_types=1);

namespace App\Dtos;

final class FilterDto
{
    private CommonFilterDto $commonFilterDto;
    private BatteryFilterDto $batteryFilterDto;
    private SolarPanelFilterDto $solarPanelFilterDto;
    private ConnectorFilterDto $connectorFilterDto;

    public function __construct(
        CommonFilterDto $commonFilterDto,
        BatteryFilterDto $batteryFilterDto,
        SolarPanelFilterDto $solarPanelFilterDto,
        ConnectorFilterDto $connectorFilterDto,
    ) {
        $this->commonFilterDto = $commonFilterDto;
        $this->batteryFilterDto = $batteryFilterDto;
        $this->solarPanelFilterDto = $solarPanelFilterDto;
        $this->connectorFilterDto = $connectorFilterDto;
    }

    public function getCommonFilterDto(): CommonFilterDto
    {
        return $this->commonFilterDto;
    }

    public function getBatteryFilterDto(): BatteryFilterDto
    {
        return $this->batteryFilterDto;
    }

    public function getSolarPanelFilterDto(): SolarPanelFilterDto
    {
        return $this->solarPanelFilterDto;
    }

    public function getConnectorFilterDto(): ConnectorFilterDto
    {
        return $this->connectorFilterDto;
    }
}
