<?php

namespace App\Models;

use App\Concerns\BelongsToTenant;
use App\Concerns\LogsActivity;
use App\Enums\UnitStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Unit extends Model
{
    use BelongsToTenant;
    use LogsActivity;
    use SoftDeletes;

    protected $fillable = [
        'number',
        'floor',
        'unit_type_id',
        'building_id',
        'tenant_id',
        'maintenance_rate',
        'unit_status',
    ];

    protected $casts = [
        'maintenance_rate' => 'decimal:2',
        'unit_status' => UnitStatus::class,
    ];

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot([
                'role',
                'from_date',
                'to_date',
            ])
            ->withTimestamps();
    }

    public function owners()
    {
        return $this->users()->wherePivot('role', 'owner');
    }

    public function tenants()
    {
        return $this->users()->wherePivot('role', 'tenant');
    }

    public function activeOwner()
    {
        return $this->owners()->wherePivotNull('to_date')
            ->wherePivot('from_date', '<=', now())
            ->first();
    }

    public function activeTenant()
    {
        return $this->tenants()->wherePivotNull('to_date')
            ->wherePivot('from_date', '<=', now())
            ->first();
    }

    public function unitType()
    {
        return $this->belongsTo(UnitType::class);
    }
}
