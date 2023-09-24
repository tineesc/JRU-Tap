<?php

namespace App\Livewire;

use App\Models\Revenue;
use Livewire\Component;
use Livewire\WithPagination;

class JeepRevenue extends Component
{
    use WithPagination;

    public $cardid;

    public function addRevenue()
    {
        // Validation rules for the cardid field
        $this->validate([
            'cardid' => 'required|numeric',
        ]);

        // Insert data into the revenue table
        Revenue::create([
            'card_id' => $this->cardid,
            // Add other fields if necessary
        ]);

        // Clear the input field after successful insertion
        $this->cardid = null;

        // Add any additional logic or messages as needed
        session()->flash('message', 'Revenue record added successfully.');

        // You can optionally redirect the user after adding the record
        // return redirect()->to('/your-redirect-url');
    }
    
    public function render()
    {
        $items = Revenue::orderBy('id','DESC')->get();
        return view('livewire.jeep-revenue', [
            'items' => Revenue::paginate(10),
        ],compact('items'));
    }
}
