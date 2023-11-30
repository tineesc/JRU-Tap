<?php

namespace App\Models;

use App\Models\User;
use App\Models\Queue;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jeep extends Model
{
    use HasFactory;
    use softDeletes;
    
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
            Queue::create([
                'driver' => $jeep->driver,
                'jnumber' => $jeep->jnumber,
                'begin' => $jeep->begin, // Use the updated 'queue' value
                'end' => $jeep->end,
                'status' => 'assigning',
                // Add any additional fields you want to copy from Jeep to Queue
            ]);
        } elseif($jeep->isDirty('end')){
            $jeep->update([
                'driver' => null,
                'queue' => null,
                'jnumber' => $jeep->jnumber,
                'begin' => null, // Use the updated 'queue' value
                'end' => null, // Set 'end' to the current datetime
            ]);
        }
    });
}

    

    
}
