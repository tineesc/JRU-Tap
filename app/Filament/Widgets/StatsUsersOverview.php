<?php

namespace App\Filament\Widgets;

use App\Models\Revenue;
use App\Models\Topup;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsUsersOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $totalTopup = Topup::sum('amount');
        $totalRevenue = Revenue::sum('fare');
        $totalAverage = Revenue::avg('fare');
        $formattedAverage = number_format($totalAverage, 2, '.', '') . '%';
        return [
            Card::make('Total Revenue Payments', $totalRevenue)
                ->description('Jeep Fares')
                ->descriptionIcon('heroicon-s-circle-stack')
                ->color('success'),
            Card::make('Total Credits Payments', $totalTopup)
                ->description('Total Topup Credits')
                ->descriptionIcon('heroicon-s-credit-card')
                ->color('warning'),
            Card::make('Average Total Credits Payment', $formattedAverage)
                ->description('3% increase')
                ->descriptionIcon('heroicon-s-arrow-trending-up')
                ->color('success'),
        ];
    }
}
