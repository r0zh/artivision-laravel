<?php

namespace App\Livewire;

use Livewire\Component;

class FilterVisibility extends Component
{
    public $filter = 'all';

    public function updateFilter()
    {
        $this->dispatch('filterUpdated', $this->filter);
    }

    public function render()
    {
        return view('livewire.artivision.components.filter-visibility');
    }
}
