<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class JeepStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        $jeep = DB::select('SELECT COUNT(*) as count FROM jeeps')[0]->count;
        $queue = DB::select('SELECT COUNT(*) as count FROM queues')[0]->count;
        $usersWithDriverRole = User::whereHas('roles', function ($query) {
            $query->where('name', 'driver');
        })->count();
        return [
            Card::make('Total Jeeps', $jeep),
            Card::make('Total Driver', $usersWithDriverRole),
            Card::make('Total Queues', $queue),
        ];
    }
}
