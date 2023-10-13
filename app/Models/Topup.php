<?php

namespace App\Models;

use App\Enums\TripStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Topup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','email','card_id','amount','status'
    ];

    protected $casts = [
        'status' => TripStatus::class,
    ];
}
