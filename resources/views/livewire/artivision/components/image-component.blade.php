<div class="relative  py-2 px-2 rounded-md hover:bg-[#6e42c185] transition-all">
    <img src="@if ($image->public == 1) {{ asset('storage/' . $image->path) }} @else {{ url($image->path) }} @endif"
        alt="{{ $image->positivePrompt }}" class="w-full rounded-lg cursor-pointer"
        wire:click="selectImage({{ $image->id }})">
</div>
