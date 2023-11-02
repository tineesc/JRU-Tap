<?php

namespace App\Filament\Resources\PermissionResource\Pages;

use App\Models\User;
use Filament\Actions;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Actions\Action;
use App\Filament\Resources\PermissionResource;

class EditPermission extends EditRecord
{
    protected static string $resource = PermissionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        $permission = $this->record;

        $auth = Auth::user();
        // Get a list of users with roles "admin" and "moderator"
        $usersWithRoles = User::whereHas('roles', function ($query) {
            $query->whereIn('id', [1, 2]);
        })->get();

        // Send the notification to each user
        foreach ($usersWithRoles as $user) {
            $notification = Notification::make()
                ->warning()
                ->icon('heroicon-o-key')
                ->title('Permission Resource Modified')
                ->body(" Permission {$permission->name} Modified by {$auth->name}!")
                ->actions([Action::make('View')->url(PermissionResource::getUrl('edit', ['record' => $permission]))])
                ->sendToDatabase($user);
        }

        return $notification; // or return a notification if needed
    }
   
   
}
