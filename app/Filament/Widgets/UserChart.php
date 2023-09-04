<?php

namespace App\Filament\Widgets;

use Carbon\Carbon;
use App\Models\User;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;

class UserChart extends ChartWidget
{
    protected static string $color = 'warning';

    protected static ?string $heading = 'Users Registered Monthly';

    protected function getData(): array
    {
        $data = Trend::model(User::class)
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perDay()
            ->count();

        return [
            'datasets' => [
                [
                    'label' => 'User Registered',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(function (TrendValue $value) {
                $date = Carbon::createFromFormat('Y-m-d', $value->date);
                $formattedDate = $date->format('M');
                return $formattedDate;
            }),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
