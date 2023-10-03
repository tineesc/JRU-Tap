<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Queue as ModelsQueue;

class Queue extends Component
{
    use WithPagination;
    
    public function render()
    {
        return view(
            'livewire.queue',
            [
                'items' => ModelsQueue::orderBy('id', 'asc')->paginate(12),
            ],
            
        );
    }
}
