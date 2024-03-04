<?php

namespace App\Livewire;

use App\Models\Image;
use Livewire\Attributes\On;
use Livewire\Component;

class Gallery extends Component
{
    public $images;

    public $filter = 'all';

    public $selectedImage = null;

    public $filteredImages;

    public function mount()
    {
        $this->images = Image::where('user_id', auth()->id())->get();
        $this->filteredImages = $this->images;
    }

    protected $listeners = ['filterUpdated' => 'updateFilterVisibility'];

    public function updateFilterVisibility($filter, $force = false)
    {
        if ($filter != $this->filter || $force) {

            $this->filter = $filter;
            $this->filteredImages = match ($filter) {
                'all' => $this->images,
                'public' => $this->images->where('public', true),
                'private' => $this->images->where('public', false),
                default => $this->images,
            };
        }
    }

    #[On('imageDeleted')]
    public function imageDeleted()
    {
        $this->images = Image::where('user_id', auth()->id())->get();
        $this->updateFilterVisibility($this->filter, true);
    }

    #[On('imageVisibilityUpdated')]
    public function imageVisibilityUpdated()
    {
        $this->images = Image::where('user_id', auth()->id())->get();
        $this->updateFilterVisibility($this->filter, true);
    }

    #[On('imageSelected')]
    public function imageSelected($id)
    {
        $this->dispatch('openModal', 'ImageDetails', ['id' => $id]);
    }

    public function render()
    {
        return view('livewire.artivision.gallery');
    }
}
