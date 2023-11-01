<?php

namespace App\Filament\Resources\CardResource\Pages;


use App\Models\User;
use App\Filament\Resources\CardResource;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateCard extends CreateRecord
{
    protected static string $resource = CardResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'New Card Generated';
    }

    protected function getCreatedNotification(): ?Notification
{
    $card = $this->record;

    // Get a list of users with roles "admin" and "moderator"
    $usersWithRoles = User::whereHas('roles', function ($query) {
        $query->whereIn('name', ['admin', 'moderator']);
    })->get();

    // Send the notification to each user
    foreach ($usersWithRoles as $user) {
     $notification  =  Notification::make()
            ->success()
            ->icon('heroicon-o-credit-card')
            ->title('Card Resource')
            ->body("** New Card {$card->card_id} Generated! **")
            ->actions([
                Action::make('View')->url(
                    CardResource::getUrl('edit', ['record' => $card]),
                    
                )
            ])
            ->sendToDatabase($user);
    }

    return $notification; // or return a notification if needed
}

}
