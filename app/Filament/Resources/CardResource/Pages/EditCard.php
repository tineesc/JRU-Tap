<?php

namespace App\Filament\Resources\CardResource\Pages;

use App\Models\User;
use Filament\Actions;
use Illuminate\Support\Facades\Auth;
use App\Filament\Resources\CardResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Actions\Action;

class EditCard extends EditRecord
{
    protected static string $resource = CardResource::class;

    protected function getHeaderActions(): array
    {
        return [Actions\DeleteAction::make()];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotification(): ?Notification
    {
        $card = $this->record;

        $auth = Auth::user();
        // Get a list of users with roles "admin" and "moderator"
        $usersWithRoles = User::whereHas('roles', function ($query) {
            $query->whereIn('id', [1, 2]);
        })->get();

        // Send the notification to each user
        foreach ($usersWithRoles as $user) {
            $notification = Notification::make()
                ->warning()
                ->icon('heroicon-o-credit-card')
                ->title('Card Resource Modified')
                ->body("**Card {$card->card_id} Modified by {$auth->name}! **")
                ->actions([Action::make('View')->url(CardResource::getUrl('edit', ['record' => $card]))])
                ->sendToDatabase($user);
        }

        return $notification; // or return a notification if needed
    }
}
