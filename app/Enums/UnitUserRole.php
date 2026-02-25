<?php

namespace App\Enums;

use Filament\Tables\Filters\Concerns\HasLabel;

enum UnitUserRole: string implements HasLabel
{
    case OWNER = 'Owner';
    case TENANT = 'Tenant';

    public function getLabel(): string
    {
        return match ($this) {
            self::OWNER => 'Owner',
            self::TENANT => 'Tenant',
        };
    }
}
