<?php

namespace App\Filament\Resources\TriplogResource\Pages;

use App\Filament\Resources\TriplogResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTriplogs extends ListRecords
{
    protected static string $resource = TriplogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
