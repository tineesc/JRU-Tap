<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class RevenueAnnualChart extends ChartWidget
{
    protected static ?string $heading = 'Annual Revenue';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Annual Revenue in All Jeepny Fares',
                    'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 200],
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
