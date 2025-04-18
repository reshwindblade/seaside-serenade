<?php

namespace App\Livewire;

use App\Models\Rule;
use Livewire\Component;

class RulesList extends Component
{
    public $rules = [];
    public $categories = [];
    public $selectedCategory = 'all';

    public function mount()
    {
        $this->loadRules();
    }

    public function loadRules()
    {
        $query = Rule::active()->ordered();
        
        if ($this->selectedCategory !== 'all') {
            $query->byCategory($this->selectedCategory);
        }
        
        $this->rules = $query->get();
        $this->categories = Rule::active()->distinct('category')->pluck('category')->toArray();
    }

    public function filterByCategory($category)
    {
        $this->selectedCategory = $category;
        $this->loadRules();
    }

    public function render()
    {
        return view('livewire.rules-list');
    }
}