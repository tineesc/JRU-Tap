<?php

namespace App\Filament\Widgets;

use App\Models\Revenue;
use Filament\Widgets\ChartWidget;

class RevenueAnnualChart extends ChartWidget
{
    protected static ?string $heading = 'Annual Revenue';

    protected function getData(): array
    {
        $annualData = Revenue::selectRaw('YEAR(created_at) as year, SUM(fare) as totalRevenue')
            ->groupBy('year')
            ->orderBy('year')
            ->pluck('totalRevenue')
            ->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Annual Revenue in All Jeep Fares',
                    'data' => $annualData,
                ],
            ],
            'labels' => range(date('Y') - 11, date('Y')), // Adjust the range based on your data
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
