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
        $this->selectedImage = Image::find($id)->id;
    }

    public function deselectImage() {
        $this->selectedImage = null;
    }

    public function deleteImage($id) {
        $image = Image::find($id);
        // destroy the image file
        $path = Str::replaceFirst('storage/', '', $image->path);
        if ($image->public) {
            Storage::disk('public')->delete($path);
            $this->dispatch('publicImageRemoved', $image);
            $image->delete();

        } else {
            Storage::disk('private')->delete($path);
            $this->dispatch('privateImageRemoved', $image);
            $image->delete();
        }
    }

    public function togglePublic($id) {
        $image = Image::find($id);
        if ($image->public) {
            $newPath = Str::replaceFirst('images/', 'private_images/', $image->path);
            Storage::disk('local')->put($newPath, Storage::disk('public')->get($image->path));
            // Storage::disk('public')->delete($image->path);
            $image->path = $newPath;
        } else {
            $newPath = Str::replaceFirst('private_images/', 'images/', $image->path);
            Storage::disk('public')->put($newPath, Storage::disk('local')->get($image->path));
            // Storage::disk('local')->delete($image->path);
            $image->path = $newPath;
        }

        $image->public = !$image->public;
        $image->save();

        // update the images
        $this->dispatch('imageVisibilityUpdated');

    }

    #[On('imageVisibilityUpdated')]
    public function imageVisibilityUpdated() {
        $this->image = Image::find($this->image->id);
    }

    public function render() {
        return view('livewire.artivision.components.image-component');
    }
}
