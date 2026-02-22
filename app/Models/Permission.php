<?php

namespace App\Models;

use App\Concerns\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use BelongsToTenant;

    protected $fillable = [
        'name',
        'code',
        'tenant_id',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, "role_permission", "permission_id", "role_id");
    }
}
