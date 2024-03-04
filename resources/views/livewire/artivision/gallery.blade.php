<div>
    <livewire:wire-elements-modal />
    <div class="py-2 rounded-lg dark:text-white dark:bg-gray-800">
        <div class="flex flex-wrap justify-center items-center space-x-4">
            <livewire:FilterVisibility />
            <livewire:OrderByDate />
            <livewire:SearchBox />
        </div>
    </div>
    @if ($images->isEmpty())
        <div class="flex justify-center items-start p-4">
            <x-alert title="There are no images to show!" secondary solid
                class="w-full lg:w-1/3 !dark:text-white !font-semibold " />
        </div>
    @else
        <div class="p-4 columns-1 sm:columns-2 md:columns-3 lg:columns-4 xl:columns-5">
            @foreach ($images as $image)
                <livewire:image-component :image="$image" :wire:key="$image->id" lazy/>
            @endforeach
        </div>
    @endempty
</div>
