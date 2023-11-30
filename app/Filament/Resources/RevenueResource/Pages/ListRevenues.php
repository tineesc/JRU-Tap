<?php

namespace App\Filament\Resources\RevenueResource\Pages;

use App\Filament\Resources\RevenueResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRevenues extends ListRecords
{
    protected static string $resource = RevenueResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public  function getTabs(): array
    {
        return [
            null => ListRecords\Tab::make('All'),
            'daily' => ListRecords\Tab::make('Today')->query(fn ($query) => $query->whereDate('created_at', today())),
            'monthly' => ListRecords\Tab::make('Monthly')->query(fn ($query) => $query->whereMonth('created_at', now()->month)),
            'yearly' => ListRecords\Tab::make('Yearly')->query(fn ($query) => $query->whereYear('created_at', now()->year)),
        ];
        
    }
}
