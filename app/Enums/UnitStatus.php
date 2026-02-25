<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum UnitStatus: string implements HasLabel
{
    case VACANT = 'Vacant';

    case OCCUPIED = 'Occupied';

    public function getLabel(): string
    {
        return match ($this) {
            self::VACANT => 'Vacant',
            self::OCCUPIED => 'Occupied',
        };
    }
}
