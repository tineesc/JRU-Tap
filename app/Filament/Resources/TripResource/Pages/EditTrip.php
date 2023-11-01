<?php

namespace App\Filament\Resources\TripResource\Pages;

use App\Filament\Resources\TripResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;

class EditTrip extends EditRecord
{
    protected static string $resource = TripResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    
   protected function getSavedNotification(): ?Notification
   {
    return Notification::make()
    ->warning()
    ->title('Trip Updated')
    ->body('Trip Successfully Updated')
    ->sendToDatabase(auth()->user());
   }
    
}
