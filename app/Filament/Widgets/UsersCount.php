<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class UsersCount extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Card::make('Unique views', '192.1k')
            ->description('32k increase')
            ->descriptionIcon('heroicon-s-arrow-trending-up')
            ->color('success'),
        Card::make('Bounce rate', '21%')
            ->description('7% increase')
            ->descriptionIcon('heroicon-s-arrow-trending-down')
            ->color('danger'),
        Card::make('Average time on page', '3:12')
            ->description('3% increase')
            ->descriptionIcon('heroicon-s-arrow-trending-up')
            ->color('success'),
        ];
    }
}
