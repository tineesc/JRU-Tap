<?php

namespace App\Filament\Resources\JeepResource\Pages;

use App\Filament\Resources\JeepResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJeep extends EditRecord
{
    protected static string $resource = JeepResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
