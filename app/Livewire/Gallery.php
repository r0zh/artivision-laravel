<?php

namespace App\Livewire;

use App\Models\Image;
use Livewire\Component;

class Gallery extends Component
{
    public $selectedImage = null;

    public $images;

    public function mount()
    {
        $this->images = Image::all();
    }

    public function selectImage($id)
    {
        $this->selectedImage = Image::find($id)->id;
    }

    public function deselectImage()
    {
        $this->selectedImage = null;
    }

    public function render()
    {
        return view('livewire.artivision.gallery');
    }
}
