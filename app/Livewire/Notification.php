<?php

namespace App\Livewire;

use Livewire\Component;

class Notification extends Component
{

    public $count;

    protected $listeners = ['notificationReceived' => 'updateCount'];

    public function mount()
    {
        $this->count = auth()->user()->notifications->count();
    }

    public function updateCount()
    {
        $this->count = auth()->user()->notifications->count();
    }
    
    public function render()
    {
        return view('livewire.notification');
    }
}
