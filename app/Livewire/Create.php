<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use App\Models\Image;

class Create extends Component {
    public $fetching;
    public $positive_prompt;
    public $negative_prompt;
    public $seed;
    public $imagePath;
    public $name;
    public $ratio = "1:1";
    public $style;
    protected $rules = [
        'name'            => 'required|string|min:2|max:255',
        'seed'            => 'required|numeric',
        'positive_prompt' => 'required|string|min:2',
        'negative_prompt' => '',
        'ratio'           => 'required',
        'style'           => 'required'
    ];

    public function mount() {
        $this->fetching = false;

    }

    public function fetch() {
        $this->fetching = true;
        $this->validate();
        $this->dispatch('fetch-image');
    }

    #[On('fetch-image')]
    public function fetchImage() {
        // get data from the form
        $this->positive_prompt;
        $this->negative_prompt;
        $this->seed;
        $json     = json_encode(['positivePrompt' => $this->positive_prompt, 'negativePrompt' => $this->negative_prompt, "seed" => $this->seed, "ratio" => $this->ratio, "style" => $this->style]);
        $address  = "https://1843-2a0c-5a85-6402-c500-dee3-dd3c-b34e-c0d2.ngrok-free.app/get_image";
        $response = Http::withBody($json, 'application/json')->timeout(120)
            ->withHeaders([
                'Content-Type' => 'application/json',
            ])->post($address);
        // display the image in the browser
        $image           = $response->getBody();
        $this->imagePath = "images/tmp/image.png";
        Storage::disk('public')->put($this->imagePath, $image);
        $this->fetching = false;
    }

    public function saveImage() {
        // move the image to the public or private directory
        $userPath = Auth::user()->id . '_' . explode('@', Auth::user()->email)[0];
        Storage::disk('public')->move($this->imagePath, 'images/' . $userPath . '/' . $this->name . '.png');

        // save the image path to the database
        $imagePath = 'images/' . $userPath . '/' . $this->name . '.png';
        Image::create([
            'seed'           => $this->seed,
            'positivePrompt' => $this->positive_prompt,
            'negativePrompt' => $this->negative_prompt,
            'public'         => true,
            'style'          => $this->style,
            // Store the image in the public or private directory
            'path'           => $imagePath,
            'created_at'     => now(),
            'user_id'        => Auth::user()->id,
        ]);

        // redirect to gallery
        return redirect()->to('/gallery');
    }


    public function render() {
        return view('livewire.artivision.create');
    }
}
