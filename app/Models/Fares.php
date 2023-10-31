<?php

namespace App\Models;

use App\Enums\FareStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Fares extends Model
{
    use HasFactory;

    protected static function booted()
    {
        static::saving(function ($model) {
            // Get the first two letters of location
            $locationFirstTwoLetters = substr($model->location, 0, 2);
    
            // Get the first two letters of destination
            $destinationFirstTwoLetters = substr($model->destination, 0, 2);
    
            // Concatenate the first two letters with fare
            $model->code = $locationFirstTwoLetters . '' . $destinationFirstTwoLetters . '' . $model->fare;
        });
    }
    
    

    
    


    protected $fillable = [
        'location',
        'destination',
        'fare',
        'code',
        'status',
    ];

    protected $casts = [
        'status' => FareStatus::class
    ];
}
