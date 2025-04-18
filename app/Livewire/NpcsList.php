<?php

namespace App\Livewire;

use App\Models\Npc;
use Livewire\Component;

class NpcsList extends Component
{
    public $npcs = [];
    public $search = '';

    public function mount()
    {
        $this->loadNpcs();
    }

    public function loadNpcs()
    {
        $query = Npc::active()->ordered();
        
        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                  ->orWhere('title', 'like', "%{$this->search}%")
                  ->orWhere('description', 'like', "%{$this->search}%");
            });
        }
        
        $this->npcs = $query->get();
    }

    public function updatedSearch()
    {
        $this->loadNpcs();
    }

    public function render()
    {
        return view('livewire.npcs-list');
    }
}