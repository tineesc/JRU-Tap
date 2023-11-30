<?php

namespace App\Filament\Widgets;

use App\Models\Revenue;
use Filament\Widgets\ChartWidget;


class RevenueMonthlyChart extends ChartWidget
{
    protected static ?string $heading = 'Monthly Revenue';

    protected function getData(): array
    {
        $monthlyData = Revenue::selectRaw('MONTH(created_at) as month, SUM(fare) as totalRevenue')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('totalRevenue')
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Monthly Revenue in All Jeep Fares',
                    'data' => $monthlyData,
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
