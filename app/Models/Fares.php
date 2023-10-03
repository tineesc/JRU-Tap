<?php

namespace App\Models;

use App\Enums\FareStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fares extends Model
{
    use HasFactory;

    protected $fillable = [
        'location',
        'destination',
        'fare',
        'status',
    ];

    protected $casts = [
        'status' => FareStatus::class
    ];
}
