<?php

namespace App\Livewire;

use App\Models\Character;
use Livewire\Component;
use Livewire\WithPagination;

class CharactersList extends Component
{
    use WithPagination;
    
    public $search = '';
    public $selectedCategory = 'all';
    public $perPage = 6;
    
    protected $queryString = [
        'search' => ['except' => ''],
        'selectedCategory' => ['except' => 'all'],
        'perPage' => ['except' => 6],
    ];
    
    public function mount()
    {
        $this->categories = [
            'all' => 'All Categories',
            'heroes' => 'Heroes',
            'villains' => 'Villains',
            'sidekicks' => 'Sidekicks',
            'mentors' => 'Mentors',
        ];
    }
    
    public function updatingSearch()
    {
        $this->resetPage();
    }
    
    public function updatingSelectedCategory()
    {
        $this->resetPage();
    }
    
    public function render()
    {
        $query = Character::query();
        
        if (!empty($this->search)) {
            $query->where(function ($q) {
                $q->where('name', 'like', "%{$this->search}%")
                    ->orWhere('description', 'like', "%{$this->search}%");
            });
        }
        
        if ($this->selectedCategory !== 'all') {
            $query->where('category', $this->selectedCategory);
        }
        
        $characters = $query->orderBy('created_at', 'desc')
            ->paginate($this->perPage);
        
        return view('livewire.characters-list', [
            'characters' => $characters,
            'categories' => $this->categories,
        ]);
    }
}