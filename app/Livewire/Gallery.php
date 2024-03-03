<?php

namespace App\Livewire;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;

class Gallery extends Component
{
    public $selectedImage = null;

    public $publicImages;

    public $privateImages;

    public $images = [];

    public $filter = 'all';

    public function mount()
    {
        $this->getPublicImages();
        $this->getPrivateImages();
        $this->images = $this->publicImages->merge($this->privateImages);
    }

    protected $listeners = ['filterUpdated' => 'updateFilterVisibility'];

    public function updateFilterVisibility($filter)
    {
        if ($filter != $this->filter) {
            $this->filter = $filter;
            switch ($filter) {
                case 'all':
                    $this->images = $this->publicImages->merge($this->privateImages);
                    break;
                case 'public':
                    $this->images = $this->publicImages;
                    break;
                case 'private':
                    $this->images = $this->privateImages;
                    break;
            }
        }
    }

    /**
     * Get public images from the user.
     */
    public function getPublicImages()
    {
        $this->publicImages = Image::where('user_id', auth()->id())
            ->where('public', true)
            ->get();
    }

    public function getPrivateImages()
    {
        $this->privateImages = Image::where('user_id', auth()->id())
            ->where('public', false)
            ->get();
    }

    public function selectImage($id)
    {
        $this->selectedImage = Image::find($id)->id;
    }

    public function deselectImage()
    {
        $this->selectedImage = null;
    }

    public function deleteImage($id)
    {
        $image = Image::find($id);
        // destroy the image file
        $path = Str::replaceFirst('storage/', '', $image->path);
        if ($image->public) {
            Storage::disk('public')->delete($path);
            $image->delete();
            $this->publicImages = $this->getPublicImages();

        } else {
            Storage::disk('private')->delete($path);
            $image->delete();
            $this->privateImages = $this->getPrivateImages();
        }
    }

    public function togglePublic($id)
    {
        $image = Image::find($id);
        if ($image->public) {
            $path = Str::replaceFirst('storage/', '', $image->path);
            Storage::disk('local')->put($path, Storage::disk('public')->get($path));
            $image->path = storage_path('$path');
        } else {
            $path = Str::replaceFirst('storage/', '', $image->path);
            Storage::disk('local')->put($path, Storage::disk('public')->get($path));
            $image->path = 'storage/'.$path;
        }
        $image->public = ! $image->public;
        $image->save();
    }

    public function render()
    {
        return view('livewire.artivision.gallery');
    }
}
