<?php

namespace App\Concerns;

use App\Models\Activity;
use Illuminate\Support\Facades\Auth;

trait LogsActivity
{
    public static function bootLogsActivity(): void
    {
        foreach (['created', 'updated', 'deleted'] as $event) {
            static::$event(function ($model) use ($event) {
                $model->recordActivity($event);
            });
        }
    }

    protected function recordActivity(string $description): void
    {
        Activity::create([
            'description' => $description,
            'subject_id' => $this->id,
            'subject_type' => get_class($this),
            'causer_id' => Auth::id(),
            'causer_type' => Auth::check() ? get_class(Auth::user()) : null,
            'properties' => $this->getLogProperties($description),
            'ip_address' => request()->ip(),
        ]);
    }

    protected function getLogProperties(string $description): array
    {
        $properties = ['attributes' => $this->getAttributes()];

        if ($description === 'updated') {
            // Get only the changed values and their original state
            $properties['old'] = array_intersect_key($this->getOriginal(), $this->getDirty());
            $properties['attributes'] = $this->getDirty();
        }

        // Clean sensitive fields (passwords, etc.)
        unset($properties['attributes']['password'], $properties['old']['password']);

        return $properties;
    }
}
