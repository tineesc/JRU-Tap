<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Credits extends Component
{
    public $showingModal = false;
    public $card_id;
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

    // public function store()
    // {
    //     $this->validate([
    //         'card_id' => 'required|string|max:255',
    //     ]);
        
    //     User::create([
    //         'card_id'
    //     ]);

    //     $this->reset('card_id');
    // }

    // public function update(User $user)
    // {
    //     $id = Auth::user()->id;
    //     $this->user = User::findorFail($id);
    //     $this->user = $user;
    //     $this->card_id = $user->card_id; 
    
    //     $this->validate([
    //         'card_id' => 'required|string|max:255',
    //     ]);

    //     $this->user->update(['card_id' => $this->card_id]);

    //     $this->reset('card_id');
 
    // }

    public function render()
    {
        return view('livewire.credits');
    }
}
