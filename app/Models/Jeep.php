<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jeep extends Model
{
    use HasFactory;

    protected $fillable = ['jnumber', 'driver', 'begin', 'end', 'notify', 'status', 'notify','queue'];

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver');
    }

    protected static function booted()
    {
        static::updated(function ($jeep) {
            if ($jeep->isDirty('queue')) {
                // Create a new Queue record when the 'queue' field is updated
                \App\Models\Queue::create([
                    'driver' => $jeep->driver,
                    'jnumber' => $jeep->jnumber,
                    'queue' => $jeep->queue, // Use the updated 'queue' value
                    'end' => $jeep->end,
                    'status' => 'assigning',
                    // Add any additional fields you want to copy from Jeep to Queue
                ]);
            }
        });
    }
    

    
}
