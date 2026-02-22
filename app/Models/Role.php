<?php

namespace App\Models;

use App\Concerns\BelongsToTenant;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use BelongsToTenant;

    protected $fillable = [
        'name',
        'code',
        'tenant_id',
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission', "role_id", "permission_id");
    }

    public function users() {
        return $this->belongsToMany(User::class, 'user_role', "role_id", "user_id");
    }
}
