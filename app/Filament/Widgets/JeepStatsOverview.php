<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class JeepStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Card::make('Total Jeeps', '35'),
            Card::make('Total Driver', '20'),
            Card::make('Total Queues', '120'),
        ];
    }
}
