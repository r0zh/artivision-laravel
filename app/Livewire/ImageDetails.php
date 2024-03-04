<?php

namespace App\Livewire;

use App\Models\Image;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\On;
use LivewireUI\Modal\ModalComponent;

class ImageDetails extends ModalComponent
{
    public $image;

    public $dateCreated;

    public function mount($id)
    {
        $this->image = Image::find($id);
        $this->dateCreated = Carbon::parse($this->image->created_at)->format('d/m/Y');
    }

    public function togglePublic()
    {
        if ($this->image->public) {
            $newPath = Str::replaceFirst('images/', 'private_images/', $this->image->path);
            Storage::disk('local')->put($newPath, Storage::disk('public')->get($this->image->path));
            // Storage::disk('public')->delete($this->image->path);
            $this->image->path = $newPath;
        } else {
            $newPath = Str::replaceFirst('private_images/', 'images/', $this->image->path);
            Storage::disk('public')->put($newPath, Storage::disk('local')->get($this->image->path));
            // Storage::disk('local')->delete($this->image->path);
            $this->image->path = $newPath;
        }

        $this->image->public = ! $this->image->public;
        $this->image->save();

        $this->dispatch('imageVisibilityUpdated');

    }

    public function deleteImage()
    {
        // destroy the image file
        $path = Str::replaceFirst('storage/', '', $this->image->path);
        if ($this->image->public) {
            Storage::disk('public')->delete($path);
            $this->image->delete();

        } else {
            Storage::disk('local')->delete($path);
            $this->image->delete();
        }
        $this->closeModal();
        $this->dispatch('imageDeleted');
    }

    #[On('imageVisibilityUpdated')]
    public function imageVisibilityUpdated()
    {
        $this->image = Image::find($this->image->id);
    }

    public function render()
    {
        return view('livewire.artivision.components.image-details');
    }
}
