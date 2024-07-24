<div>
    <div class="flex">
        <input type="text" wire:model.live="search"
               placeholder="Search areas..."
               class="p-2 rounded form-input mt-1 block border">

        <button class="rounded bg-red-700 text-white p-2 ml-2 cursor-pointer"
                wire:click="clearSearch">
            Clear
        </button>
    </div>
    <table class="table-auto w-full mt-4">
        <thead>
        <tr>
            <th class="px-4 py-2">Name</th>
            <th class="px-4 py-2">Coordinates</th>
            <th class="px-4 py-2">Start Date</th>
            <th class="px-4 py-2">End Date</th>
            <th class="px-4 py-2">Category</th>
        </tr>
        </thead>
        <tbody>
        @if($areas->isEmpty())
            <tr>
                <td colspan="5" class="border px-4 py-2 text-center">No data to display</td>
            </tr>
        @else
            @foreach($areas as $area)
                <tr>
                    <td class="border px-4 py-2">{{ $area->name }}</td>
                    <td class="border px-4 py-2">{{ $area->coordinates }}</td>
                    <td class="border px-4 py-2">{{ $area->start_date }}</td>
                    <td class="border px-4 py-2">{{ $area->end_date }}</td>
                    <td class="border px-4 py-2">
                        <span class="inline-block bg-gray-200 px-2 py-1 rounded">{{ $area->category->name }}</span>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
</div>
