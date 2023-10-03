<?php

namespace App\Livewire;

use Carbon\Carbon;
use App\Models\Card;
use App\Models\Role;
use App\Models\User;
use App\Models\Queue;
use App\Models\Revenue;
use Livewire\Component;
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
    $queueRecord = Queue::where('driver', $user->name)->first();

    if ($queueRecord) {
        // Update the "end" column in the specific record
        $queueRecord->update([
            'end' => now()->setTimezone('Asia/Manila')->format('H:i'),
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
        // Validation rules for the cardid field
        $this->validate([
            'cardid' => 'required|numeric',
            'user' => 'required',
            'fare' => 'required|numeric',
        ]);

        // Find the card with the given card_id in the Cards table
        $card = Card::where('card_id', $this->cardid)->first();

        if (!$card) {
            // Card not found
            session()->flash('error', 'Error: Card not registered .');
            $this->cardid = null;
            return;
        }

        // Check if card_balance is enough for fare
        $isCardBalanceEnough = $card->card_balance >= $this->fare;

        if ($isCardBalanceEnough) {
            // Subtract the fare from card_balance in the Cards table and update it
            $card->card_balance -= $this->fare;
            $card->save();
        }

        // Update the revenues table with status and card_balance
        $revenue = Revenue::create([
            'card_id' => $this->cardid,
            'name' => $this->user,
            'fare' => $this->fare,
            'payment_method' => 'card', // Set the payment_method to 'card'
            'status' => $isCardBalanceEnough ? 'success' : 'failed', // Set status based on condition
            'card_balance' => $card->card_balance, // Reflect updated card_balance in the revenues table
        ]);

        if ($isCardBalanceEnough) {
            session()->flash('message', 'Payment Success');
        } else {
            session()->flash('error', 'Unsufficient Funds');
        }

        // Clear the input field after successful insertion
        $this->cardid = null;

        // You can optionally redirect the user after adding the record
        // return redirect()->to('/your-redirect-url');
    }

    public function render()
    {
        $user = $this->user = Auth::user()->name;
        $items = Revenue::orderBy('id', 'DESC')->get();

        $revenue = DB::table('revenues')
            ->select('revenues.fare')
            ->where($user = 'revenues.name')
            ->get();

        return view(
            'livewire.jeep-revenue',
            [
                'items' => Revenue::orderBy('id', 'desc')->paginate(12),
            ],
            compact('items', 'revenue'),
        );
    }
}
