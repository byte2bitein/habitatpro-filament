<?php

namespace App\Concerns;

use Filament\Facades\Filament;
use Illuminate\Support\Facades\Auth;

trait BelongsToTenant
{
    public function tenant()
    {
        return $this->belongsTo(config('filament.tenancy.default_tenant_model'), 'tenant_id');
    }

    protected static function bootBelongsToTenant()
    {
        static::creating(function ($model) {
            // if (auth()->check() && !$model->tenant_id && !$model->isSuperAdmin()) {
            //     $model->tenant_id = Filament::getTenant()->id;
            //     $model->is_super_admin = false;
            // }
            if (Auth::check() && ! $model->tenant_id) {
                $model->tenant_id = Filament::getTenant()->id;
            }
        });

        // static::created(function ($model) {
        //     if (auth()->check() && !$model->isSuperAdmin()) {
        //         $tenant = Filament::getTenant();
        //         $tenant->users()->attach($model);
        //     }
        // });
    }
}
