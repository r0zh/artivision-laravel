<?php

namespace App\Livewire;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Attributes\On;

class ImageComponent extends Component {
    public $image;

    public $selectedImage = null;

    public function selectImage($id) {
        $this->dispatch('imageSelected', $id);
    }

    public function deselectImage() {
        $this->selectedImage = null;
    }

    public function deleteImage($id) {

    }

    #[On('imageVisibilityUpdated')]
    public function imageVisibilityUpdated() {
        $this->image = Image::find($this->image->id);
    }

    public function render() {
        return view('livewire.artivision.components.image-component');
    }
}
