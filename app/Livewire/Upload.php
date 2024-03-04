<?php

namespace App\Livewire;

use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Upload extends Component
{
    use WithFileUploads;

    public $image;

    public $name;

    public $seed;

    public $positivePrompt;

    public $negativePrompt;

    public $public = false;

    protected $rules = [
        'name' => 'required|string',
        'seed' => 'required|numeric',
        'positivePrompt' => 'required|string',
        'negativePrompt' => 'required|string',
        'image' => 'required|mimes:jpeg,png,jpg,gif|max:2048',
        'public' => 'boolean',
    ];

    public $id = 1;

    public function submit()
    {
        $this->validate();
        Image::create([
            'seed' => $this->seed,
            'positivePrompt' => $this->positivePrompt,
            'negativePrompt' => $this->negativePrompt,
            'public' => $this->public,
            'path' => $this->public ? Storage::disk('public')->putFileAs(
                'images/'.Auth::user()->id.'_'.explode('@', Auth::user()->email)[0],
                $this->image,
                $this->name.'.'.$this->image->getClientOriginalExtension()
            ) : Storage::disk('local')->putFileAs(
                'private_images/'.Auth::user()->id.'_'.explode('@', Auth::user()->email)[0],
                $this->image,
                $this->name.'.'.$this->image->getClientOriginalExtension()
            ),
            'created_at' => now(),
            'user_id' => Auth::user()->id,
        ]);
        $this->resetImage();
    }

    public function resetImage()
    {
        $this->reset('image');
        $this->id++;
        session()->flash('success', 'Image Reset');
    }

    public function render()
    {
        return view('livewire.artivision.upload');
    }
}
