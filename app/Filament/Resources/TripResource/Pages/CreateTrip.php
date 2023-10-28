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

    protected function afterCreate(): void
    {
        
        Notification::make()
            ->title('Sample')
            ->icon('heroicon-o-shopping-bag')
            ->body('New sample created')
            ->sendToDatabase(auth()->user());
    }
}
