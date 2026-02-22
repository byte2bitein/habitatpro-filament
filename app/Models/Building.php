<?php

namespace App\Models;

use App\Concerns\BelongsToTenant;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Building extends Pivot
{
    use BelongsToTenant;

    protected $fillable = [
        'name',
        'code',
        'tenant_id',
        'floors',
    ];
}
