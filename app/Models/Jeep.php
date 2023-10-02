<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jeep extends Model
{
    use HasFactory;

    protected $fillable = ['jnumber', 'driver', 'begin', 'end', 'notification', 'status'];

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver');
    }

    protected static function booted()
    {
        static::updated(function ($jeep) {
            // Create a new Queue record when Jeep is updated
            \App\Models\Queue::create([
                'driver' => $jeep->driver,
                'jnumber' => $jeep->jnumber,
                'begin' => $jeep->begin,
                'end' => $jeep->end,
                // Add any additional fields you want to copy from Jeep to Queue
            ]);
        });
    }
}
