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

class JeepRevenue extends Component
{
    use WithPagination;

    public $cardid;
    public $user;
    public $fare;
    public $payment;

    public function updateQueue()
    {
        $user = auth()->user(); // Get the authenticated user

        if ($user) {
            // Check if the user is listed in the Queue table
            $queueRecord = Jeep::where('driver', $user->name)->first();

            if ($queueRecord) {
                // Update the "end" column in the specific record
                $queueRecord->update([
                    'end' => now()
                        ->setTimezone('Asia/Manila')
                        ->format('H:i'),
                    'status' => 'pending',
                ]);

                Notification::make()
                    ->title('Saved successfully')
                    ->sendToDatabase($user);

                flash()->addSuccess('Notify to Queue');
                return redirect()->to('/driver');
            } else {
                flash()->addError('Not on Queue Yet Report to admin and Time IN first');
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

            DB::transaction(function () use ($isCardBalanceEnough, $card) {
                if ($isCardBalanceEnough) {
                    // Subtract the fare from card_balance in the Cards table and update it
                    $card->card_balance -= $this->fare;
                    $card->save();
                }

                // Update the revenues table with status and card_balance
                Revenue::create([
                    'card_id' => $this->cardid,
                    'name' => $this->user,
                    'fare' => $this->fare,
                    'payment_method' => 'card',
                    'status' => $isCardBalanceEnough ? 'success' : 'failed',
                    'card_balance' => $card->card_balance,
                ]);
            });

            if ($isCardBalanceEnough) {
                flash()->addSuccess('Payment Success');
            } else {
                flash()->addError('User not found');
            }
        }

        // Clear the input field after successful insertion or if the card is not found
        $this->cardid = null;

        // You can optionally redirect the user after adding the record
        return redirect()->to('/driver');
    }

    public function render()
    {
        $trips = DB::table('trips')
            ->join('users', 'trips.driver', '=', 'users.name')
            ->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->where('roles.name', 'Driver')
            ->whereColumn('trips.driver', '=', 'users.name') // Add this line
            ->select('trips.*')
            ->get();

        $user = $this->user = Auth::user()->name;
        $items = Revenue::orderBy('id', 'DESC')->get();

        return view(
            'livewire.jeep-revenue',
            [
                'items' => Revenue::orderBy('id', 'desc')->paginate(12),
            ],
            compact('items', 'trips'),
        );
    }
}
