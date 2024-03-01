<div class="p-4 columns-1 sm:columns-2 md:columns-3 lg:columns-4 xl:columns-5">
    @foreach ($images as $image)
        <div class="relative my-2 py-2 px-2 rounded-md hover:bg-[#6e42c185] transition-all">
            <img src="{{ $image->path }}" alt="{{ $image->positivePrompt }}" class="w-full rounded-lg cursor-pointer"
                wire:click="selectImage({{ $image->id }})">
            @if ($selectedImage == $image->id)
                <div class="flex fixed top-0 left-0 z-10 justify-center items-center w-full h-full bg-black bg-opacity-50"
                    wire:click="deselectImage({{ $image->id }})">
                    <div class="grid relative grid-cols-2 gap-3 p-4 bg-white rounded-xl shadow-lg"
                        onclick="event.stopPropagation()">
                        <div>
                            <img src="{{ $image->path }}" alt="{{ $image->positivePrompt }}" class="w-full h-auto">
                        </div>
                        <div class="p-2">
                            <h1 class="text-3xl font-bold">Seed</h1>
                            <p>{{ $image->seed }}</p>
                            <h1 class="text-3xl font-bold">Positive Prompt</h1>
                            <p>{{ $image->positivePrompt }}</p>
                            <h1 class="text-3xl font-bold">NegativePrompt</h1>
                            <p>{{ $image->negativePrompt }}</p>
                            <h1 class="text-3xl font-bold">User</h1>
                            <p>{{ $image->user()->name }}</p>
                        </div>
                        <svg class="absolute top-0 right-0 p-2 w-12 cursor-pointer" fill="#000000" viewBox="0 0 32 32"
                            xmlns="http://www.w3.org/2000/svg" wire:click="deselectImage">
                            <path
                                d="M18.8,16l5.5-5.5c0.8-0.8,0.8-2,0-2.8l0,0C24,7.3,23.5,7,23,7c-0.5,0-1,0.2-1.4,0.6L16,13.2l-5.5-5.5  c-0.8-0.8-2.1-0.8-2.8,0C7.3,8,7,8.5,7,9.1s0.2,1,0.6,1.4l5.5,5.5l-5.5,5.5C7.3,21.9,7,22.4,7,23c0,0.5,0.2,1,0.6,1.4  C8,24.8,8.5,25,9,25c0.5,0,1-0.2,1.4-0.6l5.5-5.5l5.5,5.5c0.8,0.8,2.1,0.8,2.8,0c0.8-0.8,0.8-2.1,0-2.8L18.8,16z" />
                        </svg>
                    </div>
                </div>
            @endif
        </div>
    @endforeach
</div>
