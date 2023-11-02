<?php

namespace App\Filament\Resources\PlacesResource\Pages;

use App\Filament\Resources\PlacesResource;
use Filament\Actions;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Actions\Action;

class EditPlaces extends EditRecord
{
    protected static string $resource = PlacesResource::class;

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
        $place = $this->record;

        $auth = Auth::user();
        // Get a list of users with roles "admin" and "moderator"
        $usersWithRoles = User::whereHas('roles', function ($query) {
            $query->whereIn('id', [1, 2]);
        })->get();

        // Send the notification to each user
        foreach ($usersWithRoles as $user) {
            $notification = Notification::make()
                ->success()
                ->icon('heroicon-o-map-pin')
                ->title('Place Resource Modified')
                ->body("Place {$place->name} Modified by {$auth->name}!")
                ->actions([Action::make('View')->url(PlacesResource::getUrl('edit', ['record' => $place]))])
                ->sendToDatabase($user);
        }

        return $notification; // or return a notification if needed
    }
}
