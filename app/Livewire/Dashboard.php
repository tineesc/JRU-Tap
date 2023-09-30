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
    $query = '%' . $this->query . '%';

    $items = Trip::where('destination', 'like', $query)
                 ->orderBy('destination', 'ASC')
                 ->paginate(12);

    return view('livewire.dashboard', [
        'items' => $items,
    ]);
}

}
