<?php

namespace App\Models;

use App\Enums\TripStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Triplog extends Model
{
    use HasFactory;


    protected $fillable = ['id', 'location', 'destination', 'date', 'time', 'driver', 'fare', 'departure', 'status'];

 
    protected $casts = [
        'status' => TripStatus::class,
    ];
}
