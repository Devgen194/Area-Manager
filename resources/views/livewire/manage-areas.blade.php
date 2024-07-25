<div>
    <div class="flex mb-4">
        <input type="text" wire:model.live="search" placeholder="Search areas..." class="p-2 rounded form-input mt-1 block border">
        <button class="rounded bg-red-700 text-white p-2 ml-2 cursor-pointer" wire:click="clearSearch">Clear</button>
    </div>

    <table class="table-auto w-full mt-4">
        <thead>
        <tr>
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Coordinates</th>
            <th class="px-4 py-2">Description</th>
            <th class="px-4 py-2">Start Date</th>
            <th class="px-4 py-2">End Date</th>
            <th class="px-4 py-2">Category</th>
            <th class="px-4 py-2">Actions</th>
        </tr>
        </thead>
        <tbody>
        @if($areas->isEmpty())
            <tr>
                <td colspan="7" class="border px-4 py-2 text-center">No data to display</td>
            </tr>
        @else
            @foreach($areas as $area)
                <tr>
                    <td class="border px-4 py-2">{{ $area->name }}</td>
                    <td class="border px-4 py-2">{{ $area->coordinates }}</td>
                    <td class="border px-4 py-2">{{ $area->description }}</td>
                    <td class="border px-4 py-2">{{ $area->start_date }}</td>
                    <td class="border px-4 py-2">{{ $area->end_date }}</td>
                    <td class="border px-4 py-2">{{ $area->category->name }}</td>
                    <td class="border p-2">
                        <button wire:click="edit({{ $area->id }})" class=" mb-2 bg-blue-500 text-white p-1 rounded ">Edit</button>
                        <button wire:click="delete({{ $area->id }})" class="bg-red-500 text-white p-1 rounded">Delete</button>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>

    @if($areaId)
        <form wire:submit.prevent="update">
            <div class="mt-4">
                <label for="name" class="block text-gray-700 font-bold mb-2">Area Name</label>
                <input type="text" id="name" wire:model.live="name" class="border rounded form-input mt-1 block w-1/2">
                @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <label for="coordinates" class="block text-gray-700 font-bold mb-2">Coordinates</label>
                <input type="text" id="coordinates" wire:model.live="coordinates" class="border rounded form-input mt-1 block w-1/2">
                @error('coordinates') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <label for="description" class="block text-gray-700 font-bold mb-2">Description</label>
                <textarea id="description" wire:model.live="description" class="border rounded form-input mt-1 block w-full"></textarea>
                @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <label for="start_date" class="block text-gray-700 font-bold mb-2">Start Date</label>
                <input type="date" id="start_date" wire:model.live="start_date" class="border rounded form-input mt-1 block w-1/2">
                @error('start_date') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <label for="end_date" class="block text-gray-700 font-bold mb-2">End Date</label>
                <input type="date" id="end_date" wire:model.live="end_date" class="border rounded form-input mt-1 block w-1/2">
                @error('end_date') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <label for="category_id" class="block text-gray-700 font-bold mb-2">Category</label>
                <select id="category_id" wire:model.live="category_id" class="border rounded form-input mt-1 block w-1/2">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <div class="mt-4">
                <label for="display_in_breach_list" class="inline-flex items-center">
                    <input type="checkbox" id="display_in_breach_list" wire:model.live="display_in_breach_list" class="form-checkbox">
                    <span class="ml-2 text-gray-700 font-bold">Display in breaches list</span>
                </label>
                @error('display_in_breach_list') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
            <button type="submit" class="mt-4 bg-blue-500 text-white p-2 rounded">Update Area</button>
        </form>
    @endif
</div>
