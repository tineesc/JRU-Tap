<?php

namespace App\Filament\Resources\TripResource\Pages;

use Filament\Actions;
use App\Filament\Resources\TripResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateTrip extends CreateRecord
{
    protected static string $resource = TripResource::class;
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Trip Created';
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
        ->success()
        ->title('Trip Created')
        ->body('New Trip Successfully Created')
        ->sendToDatabase(auth()->user());
    }
}
