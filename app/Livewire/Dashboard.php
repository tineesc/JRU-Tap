<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;

    public $query = '';
 
    public function search()
    {
        $this->resetPage();
    }

    public function render()
    {
        $items = User::orderBy('id','DESC')->get();
        return view('livewire.dashboard', [
            'items' => User::where('name', 'like', '%'.$this->query.'%')->paginate(12),
        ],compact('items'));
    }
}
