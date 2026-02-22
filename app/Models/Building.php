<?php

namespace App\Models;

use App\Concerns\BelongsToTenant;
use App\Concerns\Blameable;
use App\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use BelongsToTenant;
    use Blameable;
    use LogsActivity;

    protected $fillable = [
        'name',
        'code',
        'tenant_id',
        'floors',
    ];
}
