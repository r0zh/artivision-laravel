    <div class="flex items-center mb-4">
        <label for="toggle" class="mr-2">View:</label>
        <select id="toggle" wire:model="filter" wire:change="updateFilter" class="rounded-md border border-gray-300">
            <option value="all">All</option>
            <option value="public">Public</option>
            <option value="private">Private</option>
        </select>
    </div>
