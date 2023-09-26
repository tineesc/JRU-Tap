<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Revenue;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class JeepRevenue extends Component
{
    use WithPagination;

    public $cardid;
    public $user;
    public $fare;
    public $payment;

    public function addRevenue()
    {
        // Validation rules for the cardid field
        $this->validate([
            'cardid' => 'required|numeric',
            'user' => 'required',
            'fare' => 'required|numeric',
        ]);
    
        // Find the user with the given card_id
        $user = User::where('card_id', $this->cardid)->first();
    
        if (!$user) {
            // User not found
            session()->flash('message', 'Error: User with card ID not found.');
            return;
        }
    
        // Check if card_balance is enough for fare
        $isCardBalanceEnough = $user->card_balance >= $this->fare;
    
        if ($isCardBalanceEnough) {
            // Subtract the fare from card_balance in the users table and update remaining balance
            $user->card_balance -= $this->fare;
            $user->save();
        }
    
        // Update the revenues table with status and card_balance
        $revenue = Revenue::create([
            'card_id' => $this->cardid,
            'email' => $this->user,
            'fare' => $this->fare,
            'payment_method' => ($this->payment = 'card'),
            'status' => $isCardBalanceEnough ? 'true' : 'false', // Set status based on condition
            'card_balance' => $user->card_balance, // Reflect updated card_balance in the revenues table
        ]);
    
        if ($isCardBalanceEnough) {
            session()->flash('message', 'Revenue record added successfully with status: true.');
        } else {
            session()->flash('message', 'Revenue record added successfully with status: false.');
        }
    
        // Clear the input field after successful insertion
        $this->cardid = null;
    
        // You can optionally redirect the user after adding the record
        // return redirect()->to('/your-redirect-url');
    }
    

    public function render()
    {
        $user = $this->user = Auth::user()->email;
        $items = Revenue::orderBy('id', 'DESC')->get();

        $revenue = DB::table('revenues')
            ->select('revenues.fare')
            ->where($user = 'revenues.email')
            ->get();

        $payment = DB::table('revenues')
            ->select('revenues.*')
            ->whereRaw('card_balance < fare')
            ->get();

        return view(
            'livewire.jeep-revenue',
            [
                'items' => Revenue::orderBy('id', 'desc')->paginate(12),
            ],
            compact('items', 'revenue','payment'),
        );
    }
}
