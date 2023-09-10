<?php

namespace App\Enums;
use BenSampo\Enum\Enum;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum TripStatus: string implements HasLabel, HasColor, HasIcon
{
    case APPROVE = 'approve';
    case PENDING = 'pending';
    case DECLINE = 'decline';
    
    public function getLabel(): ?string
    {
        
        return match ($this) {
            self::APPROVE => 'approve',
            self::PENDING => 'pending',
            self::DECLINE => 'decline',
        };
    }
    public function getColor(): string | array | null
    {
        return match ($this) {
            self::APPROVE => 'success',
            self::PENDING => 'warning',
            self::DECLINE => 'gray',
        };
    }
    public function getIcon(): ?string
    {
        return match ($this) {
            self::APPROVE => 'heroicon-m-bolt',
            self::PENDING => 'heroicon-m-question-mark-circle',
            self::DECLINE => 'heroicon-m-battery-0',
        };
    }
}