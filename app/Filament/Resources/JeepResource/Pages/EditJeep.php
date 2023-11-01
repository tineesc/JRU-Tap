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
        return [
            Actions\DeleteAction::make(),
        ];
    }
   
  
    protected function getSavedNotification(): ?Notification
    {
        $jeep = $this->record;
        $auth = Auth::user();
    
        $driverName = $jeep->driver; // Assuming $jeep->driver contains the driver's name
    
        // Find the user by name and retrieve their ID
        $driver = User::where('name', $driverName)->value('id');
    
        // Create an array of users to notify (found driver ID and authenticated user)
        $usersToNotify = [$driver, $auth];
    
        $notification = null; // Initialize the notification variable
    
        // Attempt to send the notification to the last selected driver
        if (is_numeric($driver)) {
            $driverUser = User::find($driver);
            if ($driverUser instanceof \Illuminate\Contracts\Auth\Authenticatable) {
                $notification = Notification::make()
                    ->warning()
                    ->icon('heroicon-o-truck')
                    ->title('Jeep Resource Modified')
                    ->body("** Jeep {$jeep->jnumber} Modified by {$auth->name}! **")
                    ->actions([Action::make('View')->url(JeepResource::getUrl('edit', ['record' => $jeep]))])
                    ->sendToDatabase($driverUser);
            }
        }
    
        // If the notification to the last driver was not sent, send it to the authenticated user
        if (!$notification && $auth instanceof \Illuminate\Contracts\Auth\Authenticatable) {
            $notification = Notification::make()
                ->warning()
                ->icon('heroicon-o-truck')
                ->title('Jeep Resource Modified')
                ->body("** Jeep {$jeep->jnumber} Modified by {$auth->name}! **")
                ->actions([Action::make('View')->url(JeepResource::getUrl('edit', ['record' => $jeep]))])
                ->sendToDatabase($auth);
        }
    
        return $notification; // Return the notification or null if no valid user was found
    }
    
    
}
