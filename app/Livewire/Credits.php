<?php

namespace App\Livewire;

use Closure;
use App\Models\Card;
use App\Models\Topup;
use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Credits extends Component
{
    use WithPagination;
    
    public $showingModal = false;
    public $cardId;
    public $credits;
    public $user;


    // Open Modal
    public function showModal()
    {
        $this->showingModal = true;
    }

    // Close Modal
    public function closeModal()
    {
        $this->showingModal = false;
    }

    public function updatedNumber()
    {
        // Remove non-numeric characters from the input
        $this->cardId = preg_replace("/[^0-9]/", "", $this->cardId);
        $this->credits = preg_replace("/[^0-9]/", "", $this->credits);
    }

    public function rules()
    {
        return [
            'cardId' => 'required|numeric',
            'credits' => 'required|numeric',
        ];
    }


    public function render()
    {
        $user = Auth::user();
        
        $cards = Topup::where('email', $user->email)->paginate(10);

         // Calculate the total amount for each user
         $totalAmounts = Topup::select('email')
         ->selectRaw('SUM(amount) as total_amount')
         ->groupBy('email')
         ->get();
         

        $balance = DB::table('users')
            ->join('cards', 'cards.card_id', '=', 'users.card_id')
            ->where('users.id', '=', $user->id)
            ->select('cards.card_balance')
            ->first();
            if ($balance) {
                $cardBalance = $balance->card_balance;
            } else {
                $cardBalance = null; // or any default value you want to set when there's no card_balance.
            }
            
        return view('livewire.credits',compact('cardBalance','cards','totalAmounts'));
    }
}
