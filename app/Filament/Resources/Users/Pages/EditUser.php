<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\Action;
use Filament\Actions\DeleteAction;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('updatePassword')
                ->form([
                    TextInput::make('password')
                        ->required()
                        ->password()
                        ->confirmed(),
                    TextInput::make('password_confirmation')
                        ->required()
                        ->password(),
                ])
                ->action(function (array $data) {
                    $this->record->update([
                        'password' => $data['password']
                    ]);
                    Notification::make()
                        ->title('Password updated successfully.')
                        ->success()
                        ->send();
                }),
            DeleteAction::make()
                ->visible(fn($record) => auth()->user()->isSuperAdmin() || auth()->user()->can('delete', $record)),
        ];
    }

    public function afterSave(): void
    {
        $user = $this->getRecord();
        info("Broadcasing user update");
        Notification::make()
            ->title('User data updated.')
            ->broadcast($user);
    }
}
