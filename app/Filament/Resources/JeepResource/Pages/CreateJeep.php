<?php

namespace App\Filament\Resources\JeepResource\Pages;

use App\Filament\Resources\JeepResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateJeep extends CreateRecord
{
    protected static string $resource = JeepResource::class;
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Jeep Created';
    }
}
