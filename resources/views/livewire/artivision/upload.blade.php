<div class="bg-white dark:bg-gray-800">
    <form wire:submit.prevent="save" class="p-6">
        <div class="mb-4">
            <label for="photo" class="block text-gray-700 dark:text-gray-200">Upload Photo</label>
            <input type="file" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:border-indigo-500 focus:ring-indigo-500" id="photo" wire:model="photo">
            @error('photo') <span class="text-red-500 dark:text-red-300">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Upload</button>
    </form>
</div>
