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

    public $search;

    public $orderedImages;

    public $searchedImages;

    public $filteredImages;

    public $direction = 'desc';

    public function mount()
    {
        $this->images = Image::where('user_id', auth()->id())->get();
        $this->filteredImages = $this->images;
        $this->searchedImages = $this->filteredImages;
        $this->orderedImages = $this->searchedImages->sortByDesc('created_at');
    }

    #[On('filterUpdated')]
    public function updateFilterVisibility($filter)
    {
        if ($filter != $this->filter) {
            $this->filter = $filter;
            $this->getImages();
        }
    }

    #[On('searchUpdated')]
    public function updateSearch($search)
    {
        if ($search != $this->search) {
            $this->search = $search;
            $this->getImages();
        }

    }

    #[On('orderUpdated')]
    public function updateOrder($direction)
    {
        if ($direction != $this->direction) {
            $this->direction = $direction;
            $this->getImages();
        }
    }

    public function getImages()
    {
        if ($this->filter == 'all') {
            $this->images = Image::where('user_id', auth()->id())
                ->where('positivePrompt', 'like', '%'.$this->search.'%')
                ->orderBy('created_at', $this->direction)
                ->get();
        } elseif ($this->filter == 'public') {
            $this->images = Image::where('user_id', auth()->id())
                ->where('public', true)
                ->where('positivePrompt', 'like', '%'.$this->search.'%')
                ->orderBy('created_at', $this->direction)
                ->get();
        } elseif ($this->filter == 'private') {
            $this->images = Image::where('user_id', auth()->id())
                ->where('public', false)
                ->where('positivePrompt', 'like', '%'.$this->search.'%')
                ->orderBy('created_at', $this->direction)
                ->get();
        }
    }

    #[On('imageDeleted')]
    public function imageDeleted()
    {
        $this->getImages();
    }

    #[On('imageVisibilityUpdated')]
    public function imageVisibilityUpdated()
    {
        $this->getImages();
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
