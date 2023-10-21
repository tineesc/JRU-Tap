<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class RevenueMonthlyChart extends ChartWidget
{
    protected static ?string $heading = 'Monthly Revenue';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Monthly Revenue in All Jeepny Fares',
                    'data' => [0, 10, 5, 2, 21, 32, 45, 74, 65, 45, 77, 200],
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
