<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsUsersOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Card::make('Total Revenue Payments', '192.1k')
                ->description('32k increase')
                ->descriptionIcon('heroicon-s-arrow-trending-up')
                ->color('success'),
            Card::make('Total Credits Payments', '212k')
                ->description('7% decrease')
                ->descriptionIcon('heroicon-s-arrow-trending-down')
                ->color('danger'),
            Card::make('Average Total Credits Payment', '32%')
                ->description('3% increase')
                ->descriptionIcon('heroicon-s-arrow-trending-up')
                ->color('success'),
        ];
    }
}
