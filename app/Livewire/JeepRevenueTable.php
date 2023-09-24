<?php

namespace App\Livewire;

use App\Models\Revenue;
use Livewire\Component;
use Livewire\WithPagination;

class JeepRevenueTable extends Component
{
    use WithPagination;
    
    public function render()
    {
        $items = Revenue::orderBy('id','DESC')->get();
        return view('livewire.jeep-revenue-table', [
            'items' => Revenue::paginate(10),
        ],compact('items'));
    }
}
