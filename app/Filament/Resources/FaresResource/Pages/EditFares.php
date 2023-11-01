<?php

namespace App\Filament\Resources\FaresResource\Pages;

use App\Models\User;
use Filament\Actions;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\FaresResource;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;

class EditFares extends EditRecord
{
    protected static string $resource = FaresResource::class;

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
        $fare = $this->record;

        $auth = Auth::user();
        // Get a list of users with roles "admin" and "moderator"
        $usersWithRoles = User::whereHas('roles', function ($query) {
            $query->whereIn('id', [1, 2]);
        })->get();

        // Send the notification to each user
        foreach ($usersWithRoles as $user) {
            $notification = Notification::make()
                ->warning()
                ->icon('heroicon-o-presentation-chart-bar')
                ->title('Fare Resource Modified')
                ->body("** Fare {$fare->code} Modified by {$auth->name}! **")
                ->actions([Action::make('View')->url(FaresResource::getUrl('edit', ['record' => $fare]))])
                ->sendToDatabase($user);
        }

        return $notification; // or return a notification if needed
    }
}
