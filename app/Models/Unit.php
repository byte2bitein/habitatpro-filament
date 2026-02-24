<?php

namespace App\Models;

use App\Concerns\BelongsToTenant;
use App\Concerns\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use BelongsToTenant;
    use LogsActivity;

    protected $fillable = [
        'number',
        'floor',
        'unit_type_id',
        'building_id',
        'tenant_id',
        'maintenance_rate',
    ];

    protected $casts = [
        'maintenance_rate' => 'decimal:2',
    ];

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function owners()
    {
        return $this->belongsToMany(User::class, 'unit_owner')->withTimestamps();
    }

    public function unitType()
    {
        return $this->belongsTo(UnitType::class);
    }
}
