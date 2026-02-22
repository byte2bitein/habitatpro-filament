<?php

namespace App\Models;

use App\Concerns\BelongsToTenant;
use App\Concerns\Blameable;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use BelongsToTenant;
    use Blameable;

    protected $fillable = [
        'name',
        'code',
        'tenant_id',
        'floors',
    ];
}
