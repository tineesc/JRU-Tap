<?php

namespace App\Models;

use App\Models\Jeep;
use App\Models\Triplog;
use App\Enums\TripStatus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'location', 'destination', 'date', 'time', 'driver', 'fare', 'departure', 'status', 'jnumber'];

    protected static function boot()
    {
        parent::boot();
    
        static::updating(function ($trip) {
            if ($trip->isDirty('status') && in_array($trip->status, [TripStatus::APPROVE, TripStatus::DECLINE])) {
                try {
                    DB::transaction(function () use ($trip) {
                        $trip->logTrip();
                       
                    });
                } catch (\Exception $e) {
                    return back()->with('message', 'Trip Successfully Arrive');
                }
            }
        });
    }
    
    public function logTrip()
    {
        try {
            DB::transaction(function () {
                // Create a new entry in the triplog table
                TripLog::create([
                    'id' => $this->id,
                    'location' => $this->location,
                    'destination' => $this->destination,
                    'date' => $this->date,
                    'time' => $this->time,
                    'driver' => $this->driver,
                    'fare' => $this->fare,
                    'departure' => $this->departure,
                    'status' => $this->status,
                ]);
            });

            $this->delete();
    
            // Redirect to the admin trips page
            return back()->with('message', 'Trip logged successfully');
        } catch (\Exception $e) {
            return back()->with('message', 'Trip Successfully Arrive');
        }
    }
     
    

    public function Jeep(): BelongsTo
    {
        return $this->belongsTo(Jeep::class);
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => TripStatus::class,
    ];

   
}
