<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Card;
use App\Models\Jeep;
use App\Models\Role;
use App\Models\Trip;
use App\Models\User;
use App\Models\Queue;
use App\Models\Revenue;
use Livewire\Component;
use App\Enums\TripStatus;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Filament\Notifications\Notification;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Events\DatabaseNotificationsSent;

class JeepRevenue extends Component
{
    use WithPagination;

    public $cardid;
    public $user;
    public $fare;
    public $payment;
    public $count;

    public function mount()
    {
        $trips = DB::table('trips')
            ->join('users', 'trips.driver', '=', 'users.name')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('roles.name', 'Driver')
            ->whereColumn('trips.driver', '=', 'users.name')
            ->select('trips.fare')
            ->first();

        if ($trips) {
            $this->fare = $trips->fare;
        }

    }

    public function break()
    {
        $user = Auth::user();

        if ($user) {
            $jeep = Jeep::where('driver', $user->name)->first();

            if ($jeep) {
                $jeep->request = 'break';
                $jeep->status = 'pending';
                $jeep->save();
                flash()->addSuccess('Request Sent Successfully');
                return redirect()->to('/driver');
            } else {
                flash()->addError('Something went wrong!');
                return redirect()->to('/driver');
            }
        }
    }

    public function lunch()
    {
        $user = Auth::user();

        if ($user) {
            $jeep = Jeep::where('driver', $user->name)->first();

            if ($jeep) {
                $jeep->request = 'lunch';
                $jeep->status = 'pending';
                $jeep->save();
                flash()->addSuccess('Request Sent Successfully');
                return redirect()->to('/driver');
            } else {
                flash()->addError('Something went wrong!');
                return redirect()->to('/driver');
            }
        }
    }

    public function driving()
    {
        // Check if the user has an assigned trip and is marked as the driver
        $trip = Trip::where('driver', Auth::user()->name)->first();

        if ($trip) {
            // Update the "time" column with the current time
            $trip->update([
                'time' => now()
                    ->setTimezone('Asia/Manila')
                    ->format('H:i'),
            ]);

            // You may also update the "status" to mark it as completed or in-progress, as needed
            // $trip->update(['status' => 'completed']);

            // You can add additional logic here as per your requirements
            Notification::make()
                ->success()
                ->icon('heroicon-o-megaphone')
                ->title('Driver Driving Notification')
                ->body(Auth::user()->name . 'Leave the Terminal Start Driving')
                ->sendToDatabase(
                    User::whereHas('roles', function ($query) {
                        $query->where('id', [1, 2]);
                    })->get(),
                );
            // Display a success message
            flash()->addSuccess('Driving Time updated Successfully');
            return redirect()->to('/driver');
        } else {
            // Display an error message
            flash()->addError('No assigned trip for you.');
            return redirect()->to('/driver');
        }
    }

    public function departure()
    {
        // Check if the user has an assigned trip and is marked as the driver
        $trip = Trip::where('driver', Auth::user()->name)->first();

        if ($trip) {
            // Update the "time" column with the current time
            $trip->update([
                'departure' => now()
                    ->setTimezone('Asia/Manila')
                    ->format('H:i'),
                    'count' => 1,
            ]);

            // Increment the "count" attribute by 1
        $trip->increment('count');

        // Check if 24 hours have passed since the count was last reset
        $resetTime = now()->subHours(24);
        if ($trip->updated_at <= $resetTime) {
            $trip->update(['count' => 0]); // Reset count to 0
        }

            // You may also update the "status" to mark it as completed or in-progress, as needed
            $trip->update(['status' => 'completed']);

            // You can add additional logic here as per your requirements
            Notification::make()
                ->success()
                ->icon('heroicon-o-check-badge')
                ->title('Driver Departure Notification')
                ->body(Auth::user()->name . 'Arrive on Departure Destination')
                ->sendToDatabase(
                    User::whereHas('roles', function ($query) {
                        $query->where('id', [1, 2]);
                    })->get(),
                );
            // Display a success message
            flash()->addSuccess('Departure Time updated Successfully');
            return redirect()->to('/driver');
        } else {
            // Display an error message
            flash()->addError('No assigned trip for you.');
            return redirect()->to('/driver');
        }
    }

    public function failed()
    {
        // Check if the user has an assigned trip and is marked as the driver
        $trip = Trip::where('driver', Auth::user()->name)->first();

        if ($trip) {
            // Update the "time" column with the current time
            $trip->update([
                'departure' => now()
                    ->setTimezone('Asia/Manila')
                    ->format('H:i'),
            ]);

            // You may also update the "status" to mark it as completed or in-progress, as needed
            $trip->update(['status' => 'failed']);

            // You can add additional logic here as per your requirements
            Notification::make()
                ->success()
                ->icon('heroicon-o-check-badge')
                ->title('Driver Failure Notification')
                ->body(Auth::user()->name . 'Failure on Departure Destination')
                ->sendToDatabase(
                    User::whereHas('roles', function ($query) {
                        $query->where('id', [1, 2]);
                    })->get(),
                );
            // Display a success message
            flash()->addSuccess('Failure Departure Time updated Successfully');
            return redirect()->to('/driver');
        } else {
            // Display an error message
            flash()->addError('No assigned trip for you.');
            return redirect()->to('/driver');
        }
    }

    public function updateQueue()
    {
        $user = auth()->user(); // Get the authenticated user

        if ($user) {
            // Check if the user is listed in the Queue table
            $queueRecord = Jeep::where('driver', $user->name)->first();

            if ($queueRecord) {
                // Update the "end" column in the specific record
                $queueRecord->update([
                    'notify' => now()
                        ->setTimezone('Asia/Manila')
                        ->format('H:i'),
                    'status' => 'pending',
                    
                ]);

                Notification::make()
                    ->success()
                    ->icon('heroicon-o-truck')
                    ->title('Driver Queue Notification')
                    ->body(Auth::user()->name . ' Request to add on queue')
                    ->sendToDatabase(
                        User::whereHas('roles', function ($query) {
                            $query->where('id', [1, 2]);
                        })->get(),
                    );

                // event(new DatabaseNotificationsSent($user));

                flash()->addSuccess('Notify to Queue');
                return redirect()->to('/driver');
            } else {
                flash()->addError('No Jeep Assign!');
            }
        }

        return redirect()->to('/driver');
    }

    public function addRevenue()
    {
        // Find the card with the given card_id in the Cards table
        $card = Card::where('card_id', $this->cardid)->first();

        if (!$card) {
            // Card not found
            flash()->addError('Error: Card not Registered');
        } else {
            // Check if card_balance is enough for fare
            $isCardBalanceEnough = $card->card_balance >= $this->fare;

            if ($isCardBalanceEnough) {
                DB::transaction(function () use ($card) {
                    // Subtract the fare from card_balance in the Cards table and update it
                    $card->card_balance -= $this->fare;
                    $card->save();

                    // Update the revenues table with status and card_balance
                    Revenue::create([
                        'card_id' => $this->cardid,
                        'name' => $this->user,
                        'fare' => $this->fare,
                        'payment_method' => 'card',
                        'status' => 'success',
                        'card_balance' => $card->card_balance,
                    ]);
                });

                flash()->addSuccess('Payment Success');
            } else {
                flash()->addError('Insufficient Balance');
            }
        }

        // Clear the input field after successful insertion or if the card is not found
        $this->cardid = null;

        // You can optionally redirect the user after adding the record
        return redirect()->to('/driver');
    }

    public function render()
    {
        $userName = $this->user = Auth::user()->name;
        $items = Revenue::orderBy('id', 'DESC')->get();

        $user = Auth::user();
        $driverName = $user->name;

        $trips = DB::table('trips')
            ->join('users', 'trips.driver', '=', 'users.name')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('roles.name', 'Driver')
            ->where('trips.driver', $driverName) // Filter by the current driver's name
            ->select('trips.*')
            ->get();

        $cardData = DB::table('revenues')
            ->join('cards', 'revenues.card_id', '=', 'cards.card_id')
            ->select('revenues.card_id', 'cards.card_balance')
            ->get();

        $jnumber = DB::table('jeeps')
            ->join('users', 'jeeps.driver', '=', 'users.name')
            ->where('users.name', '=', $userName)
            ->select('jeeps.*')
            ->get();

        return view(
            'livewire.jeep-revenue',
            [
                'items' => Revenue::orderBy('id', 'desc')->paginate(10),
            ],
            compact('items', 'trips', 'cardData', 'jnumber'),
        );
    }
}
