<?php

namespace App\Livewire;

use App\Models\Trip;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;

    public $query = '';
    public $locationFilter = '';
    public $destinationFilter = '';

    public function search()
    {
        $this->resetPage();
    }

    public function reloadPage()
    {
        $this->reset();
        return redirect()->to('/dashboard'); // Change '/your-dashboard-route' to your actual route
    }

    public function render()
    {
        $query = '%' . $this->query . '%';

        $items = Trip::where('destination', 'like', $query);

        // Apply location filter if selected
        if ($this->locationFilter) {
            $items->where('location', $this->locationFilter);
        }

        // Apply destination filter if selected
        if ($this->destinationFilter) {
            $items->where('destination', $this->destinationFilter);
        }


        $items = $items->orderBy('destination', 'ASC')
                       ->paginate(5);

        $locations = Trip::select('location')->distinct()->get();
        $destinations = Trip::select('destination')->distinct()->get();

        return view('livewire.dashboard',compact('items','destinations','locations'));
    }
}
