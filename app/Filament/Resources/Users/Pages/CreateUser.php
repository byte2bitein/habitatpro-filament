<?php

namespace App\Filament\Resources\Users\Pages;

use App\Events\UserCreated;
use App\Filament\Resources\Users\UserResource;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected function afterCreate(): void
    {
        $user = $this->getRecord();
        if ($user) {
            UserCreated::dispatch($user);
        }
    }
}
