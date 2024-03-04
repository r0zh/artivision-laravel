<?php

namespace App\Livewire;

use Livewire\Component;

class SearchBox extends Component
{
    public $search = '';

    public function updateSearch()
    {
        $this->dispatch('searchUpdated', $this->search);
    }

    public function render()
    {
        return view('livewire.artivision.components.search-box');
    }
}
