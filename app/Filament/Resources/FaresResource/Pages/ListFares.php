<?php

namespace App\Filament\Resources\FaresResource\Pages;

use App\Filament\Resources\FaresResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFares extends ListRecords
{
    protected static string $resource = FaresResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
