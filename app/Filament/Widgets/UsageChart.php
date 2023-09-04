<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class UsageChart extends ChartWidget
{
    protected static ?string $heading = 'Application Usage';

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Application Usage',
                    'data' => [5, 10,],
                    'backgroundColor' => [
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)'
                    ],
                ],
            ],
            'labels' => ['Mobile', 'Desktop'],
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
