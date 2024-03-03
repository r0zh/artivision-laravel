<div>
@livewire('wire-elements-modal')
    @livewire('FilterVisibility')
    @empty($images)
        <p>There are no images.</p>
    @else
        <div class="p-4 columns-1 sm:columns-2 md:columns-3 lg:columns-4 xl:columns-5">
            @foreach ($filteredImages as $image)
                <livewire:image-component :image="$image" :wire:key="$image->id" />
            @endforeach
        </div>
    @endempty
</div>
