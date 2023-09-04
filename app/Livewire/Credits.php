<?php

namespace App\Livewire;

use Livewire\Component;

class Credits extends Component
{
    public $showingModal = false;

    public function showModal()
    {
        $this->showingModal = true;
    }
    public function render()
    {
        return view('livewire.credits');
    }
}
