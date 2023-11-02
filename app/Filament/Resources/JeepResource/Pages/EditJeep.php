<?php

namespace App\Filament\Resources\JeepResource\Pages;

use App\Models\User;
use Filament\Actions;
use Illuminate\Support\Facades\Auth;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\JeepResource;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;

class EditJeep extends EditRecord
{
    protected static string $resource = JeepResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Jeep Modified';
    }

    protected function getHeaderActions(): array
    {
        return [Actions\DeleteAction::make()];
    }

    protected function getSavedNotification(): ?Notification
    {
        $jeep = $this->record;
        $auth = Auth::user();
    
        $driverName = $jeep->driver; // Assuming $jeep->driver contains the driver's name
    
        // Find the user by name and retrieve their ID
        $driver = User::where('name', $driverName)->value('id');
        $driverUser = User::find($driver);
    
        $notification = null; // Initialize the notification variable
    
        if ($jeep->driver === null) {
            $notification = Notification::make()
                ->info()
                ->icon('heroicon-o-truck')
                ->title('Jeep Resource Modified')
                ->body('No Driver Assigned!')
                ->sendToDatabase($auth);
        } elseif ($jeep->wasChanged('begin')) {
            $notification = Notification::make()
                ->success()
                ->icon('heroicon-o-truck')
                ->title('Jeep Resource Modified')
                ->body("Time IN!")
                ->actions([Action::make('View')->url(JeepResource::getUrl('edit', ['record' => $jeep]))])
                ->sendToDatabase([$driverUser, $auth]);
        } elseif ($jeep->wasChanged('queue')) {
            $notification = Notification::make()
                ->success()
                ->icon('heroicon-o-truck')
                ->title('Jeep Resource Modified')
                ->body("Queue!")
                ->actions([Action::make('View')->url(JeepResource::getUrl('edit', ['record' => $jeep]))])
                ->sendToDatabase([$driverUser, $auth]);
        } elseif ($jeep->wasChanged('end')) {
            $notification = Notification::make()
                ->success()
                ->icon('heroicon-o-truck')
                ->title('Jeep Resource Modified')
                ->body("Time OUT!")
                ->actions([Action::make('View')->url(JeepResource::getUrl('edit', ['record' => $jeep]))])
                ->sendToDatabase([$driverUser, $auth]);
        } elseif ($jeep->driver !== null) {
            $notification = Notification::make()
                ->success()
                ->icon('heroicon-o-truck')
                ->title('Jeep Resource Modified')
                ->body("Driver {$jeep->driver} Assigned to {$jeep->jnumber}")
                ->sendToDatabase($auth);
        }
    
        return $notification;
    }
    
}
