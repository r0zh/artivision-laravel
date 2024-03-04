<?php

namespace App\Livewire;

use App\Models\Image;
use Livewire\Attributes\On;
use Livewire\Component;

class community extends Component {
    public $images;

    public $selectedImage = null;

    public $search;

    public $orderedImages;

    public $searchedImages;

    public $filteredImages;

    public $direction = 'desc';

    public function mount() {
        $this->images         = Image::all()->where('public', true);
        $this->filteredImages = $this->images;
        $this->searchedImages = $this->filteredImages;
        $this->orderedImages  = $this->searchedImages->sortByDesc('created_at');
    }

    #[On('searchUpdated')]
    public function updateSearch($search) {
        if ($search != $this->search) {
            $this->search = $search;
            $this->getImages();
        }

    }

    #[On('orderUpdated')]
    public function updateOrder($direction) {
        if ($direction != $this->direction) {
            $this->direction = $direction;
            $this->getImages();
        }
    }

    public function getImages() {
        $this->images = Image::where('positivePrompt', 'like', '%' . $this->search . '%')->
            where('public', true)
            ->orderBy('created_at', $this->direction)
            ->get();
    }

    #[On('imageDeleted')]
    public function imageDeleted() {
        $this->getImages();
    }

    #[On('imageVisibilityUpdated')]
    public function imageVisibilityUpdated() {
        $this->getImages();
    }

    #[On('imageSelected')]
    public function imageSelected($id) {
        $this->dispatch('openModal', 'ImageDetails', ['id' => $id]);
    }

    public function render() {
        return view('livewire.artivision.community');
    }
}
