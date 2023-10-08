<?php

namespace App\Enums;
use BenSampo\Enum\Enum;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum TripStatus: string implements HasLabel, HasColor, HasIcon
{
    case APPROVE = 'completed';
    case PENDING = 'pending';
    case DECLINE = 'failed';
    case ONGOING = 'on going';
    case ARCHIVE = 'archive'; // Add the "ARCHIVE" status
    
    public function getLabel(): ?string
    {
        
        return match ($this) {
            self::APPROVE => 'complete',
            self::PENDING => 'pending',
            self::ONGOING => 'on going',
            self::DECLINE => 'failed',
            self::ARCHIVE => 'archive', // Label for "ARCHIVE" status
        };
    }
    public function getColor(): string | array | null
    {
        return match ($this) {
            self::APPROVE => 'success',
            self::PENDING => 'warning',
            self::DECLINE => 'gray',
            self::ONGOING => 'info',
            self::ARCHIVE => 'info', // Color for "ARCHIVE" status
        };
    }
    public function getIcon(): ?string
    {
        return match ($this) {
            self::APPROVE => 'heroicon-m-bolt',
            self::PENDING => 'heroicon-m-question-mark-circle',
            self::DECLINE => 'heroicon-m-battery-0',
            self::ONGOING => 'heroicon-m-battery-0',
            self::ARCHIVE => 'heroicon-m-archive', // Icon for "ARCHIVE" status
        };
    }
}