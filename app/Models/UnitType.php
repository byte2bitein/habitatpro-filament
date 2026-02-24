<?php

namespace App\Models;

use App\Concerns\BelongsToTenant;
use App\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class UnitType extends Model
{
    use BelongsToTenant;
    use LogsActivity;

    protected $fillable = [
        'name',
        'description',
        'tenant_id',
    ];
}
