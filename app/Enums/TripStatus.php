<?php

namespace App\Enums;
use BenSampo\Enum\Enum;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum TripStatus: string implements HasLabel, HasColor, HasIcon
{
    case AVAILABLE = 'Available';
    case NOTAVAILABLE = 'Not Available';
    
    public function getLabel(): ?string
    {
        
        return match ($this) {
            self::AVAILABLE => 'Available',
            self::NOTAVAILABLE => 'Not Available',
        };
    }
    public function getColor(): string | array | null
    {
        return match ($this) {
            self::AVAILABLE => 'success',
            self::NOTAVAILABLE => 'gray',
        };
    }
    public function getIcon(): ?string
    {
        return match ($this) {
            self::AVAILABLE => 'heroicon-m-bolt',
            self::NOTAVAILABLE => 'heroicon-m-battery-0',
        };
    }
}