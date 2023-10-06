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

    protected $fillable = ['id', 'location', 'destination', 'date', 'time', 'driver', 'fare', 'departure', 'status'];

    protected static function boot()
{
    parent::boot();

    static::updating(function ($trip) {
        if ($trip->isDirty('status') && $trip->status === TripStatus::APPROVE) {
            DB::transaction(function () use ($trip) {
                $trip->logTrip();
                // $trip->deleteTrip(); // Call the deleteTrip method
                // You may return a response here if needed
            });
        }

        return true; // Allow the update to proceed
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
                    'status' => $this->status, // Set the status from the current trip
                ]);
                
            });
    
            // Redirect to the admin trips page
            return back()->with('message', 'Trip logged and archived successfully');
        } catch (\Exception $e) {
            // Handle the error and redirect to the admin trips page with an error message
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    
    public function deleteTrip()
    {
        try {
            // Check if the status is 'approve', and then delete the record
            if ($this->status === TripStatus::APPROVE) {
                $this->delete();
            }
        } catch (\Exception $e) {
            // Handle the error and log it or display an error message
            // You can also redirect to a specific page or return a response
            // For example, log the error and redirect to an error page:
            Log::error('Error deleting trip: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while deleting the trip: ' . $e->getMessage());
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
