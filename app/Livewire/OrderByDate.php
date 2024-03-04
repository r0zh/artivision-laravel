<?php

namespace App\Livewire;

use Livewire\Component;

class OrderByDate extends Component
{
    public $direction = 'desc';

    public function updateOrder()
    {
        $this->dispatch('orderUpdated', $this->direction);
    }

    public function render()
    {
        return view('livewire.artivision.components.order-by-date');
    }
}
