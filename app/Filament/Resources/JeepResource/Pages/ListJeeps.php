<?php

namespace App\Filament\Resources\JeepResource\Pages;

use App\Filament\Resources\JeepResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJeeps extends ListRecords
{
    protected static string $resource = JeepResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
