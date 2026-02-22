<?php

namespace App\Enums;
use Filament\Support\Contracts\HasLabel;

enum SocietyType: string implements HasLabel
{
    case RESIDENTIAL_APARTMENTS = "residential-apartments";
    case RESIDENTIAL_TENAMENTS = "residential-tenaments";
    case RESIDENTIAL_BUNGLOWS = "residential-bunglows";
    case RESIDENTIAL_AND_COMMERCIAL = "residential-and-commercial";

    public function label(): string
    {
        return match ($this) {
            self::RESIDENTIAL_APARTMENTS => "Residential apartments",
            self::RESIDENTIAL_TENAMENTS => "Residential tenaments",
            self::RESIDENTIAL_BUNGLOWS => "Residential bunglows",
            self::RESIDENTIAL_AND_COMMERCIAL => "Residential and commercial",
        };
    }

    public function getLabel(): string
    {
        return match ($this) {
            self::RESIDENTIAL_APARTMENTS => "Residential apartments",
            self::RESIDENTIAL_TENAMENTS => "Residential tenaments",
            self::RESIDENTIAL_BUNGLOWS => "Residential bunglows",
            self::RESIDENTIAL_AND_COMMERCIAL => "Residential and commercial",
        };
    }

    public static function values(): array
    {
        return array_column(self::cases(), "value");
    }
}