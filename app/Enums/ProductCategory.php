<?php

namespace App\Enums;

enum ProductCategory: string
{
    case Battery = 'battery';
    case SolarPanel = 'solar_panel';
    case Connector = 'connector';

    public function label(): string
    {
        return match ($this) {
            self::Battery => 'Batteries',
            self::SolarPanel => 'Solar panels',
            self::Connector => 'Connectors',
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
