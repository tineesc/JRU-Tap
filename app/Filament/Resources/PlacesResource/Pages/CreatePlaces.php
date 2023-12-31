<?php

namespace App\Filament\Resources\PlacesResource\Pages;

use App\Filament\Resources\PlacesResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\User;
use Filament\Actions;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;


class CreatePlaces extends CreateRecord
{
    protected static string $resource = PlacesResource::class;


    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
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
                ->title('Place Resource Created')
                ->body("New Place {$place->name} Generated by {$auth->name}!")
                ->actions([Action::make('View')->url(PlacesResource::getUrl('edit', ['record' => $place]))])
                ->sendToDatabase($user);
        }

        return $notification; // or return a notification if needed
    }
}
