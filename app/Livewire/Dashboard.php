<?php

namespace App\Livewire;

use App\Models\Trip;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    public $status;

    use WithPagination;

    public $query = '';
 
    public function search()
    {
        $this->resetPage();
    }

   

    public function render()
    {
        $items = Trip::orderBy('id','DESC')->get();
        return view('livewire.dashboard', [
            'items' => Trip::where('location', 'like', '%'.$this->query.'%')->paginate(12),
        ],compact('items'));
    }
}
