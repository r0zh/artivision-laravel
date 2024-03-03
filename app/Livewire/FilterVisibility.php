<?php

namespace App\Livewire;


use LivewireUI\Modal\ModalComponent;

class FilterVisibility extends ModalComponent {
    public $filter = 'all';

    public function updateFilter() {
        $this->dispatch('filterUpdated', $this->filter);
    }

    public function render() {
        return view('livewire.artivision.components.filter-visibility');
    }
}
