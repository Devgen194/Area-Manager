@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <div class="flex flex-col lg:flex-row space-y-6 lg:space-y-0 lg:space-x-6">
            <div class="flex-1">
                <div id="map" class="h-96 rounded-md shadow">
                    @include('component.map')
                </div>
            </div>
            <div class="w-full h-1/2 lg:w-1/3 bg-white rounded-md shadow p-4">
                @if ($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Whoops!</strong>
                        <span class="block sm:inline">Something went wrong.</span>
                        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <form action="{{ route('areas.store') }}" method="POST">
                    @csrf

                    <input type="hidden" id="coordinates" name="coordinates" value="{{ old('coordinates') }}">

                    <div class="mb-4">
                        <label for="geojsonFile" class="block text-gray-700 font-bold mb-2">Click here to select files to upload (or drag & drop files):</label>
                        <input type="file" id="geojsonFile" name="geojsonFile" class="form-input mt-1 block w-1/2">
                    </div>
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-bold mb-2">Area Name</label>
                        <input type="text" id="name" name="name" class="border rounded form-input mt-1 block w-1/2">
                    </div>
                    <div class="mb-4">
                        <label for="description" class="block text-gray-700 font-bold mb-2">Area Description (optional)</label>
                        <textarea id="description" name="description" class="border rounded form-input mt-1 block w-full"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="category_id" class="block text-gray-700 font-bold mb-2">Category</label>
                        <select id="category_id" name="category_id" class="w-full" >
                            <option value="" disabled selected>Please select category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="start_date" class="block text-gray-700 font-bold mb-2">Valid From</label>
                        <input type="date" id="start_date" name="start_date" class="border rounded form-input mt-1 block w-1/2">
                    </div>
                    <div class="mb-4">
                        <label for="end_date" class="block text-gray-700 font-bold mb-2">Valid To (optional)</label>
                        <input type="date" id="end_date" name="end_date" class="border rounded form-input mt-1 block w-1/2">
                    </div>
                    <div class="mb-4">
                        <label for="display_in_breach_list" class="inline-flex items-center">
                            <input type="checkbox" id="display_in_breach_list" name="display_in_breach_list" class="form-checkbox" {{ old('display_in_breach_list') ? 'checked' : '' }}>
                            <span class="ml-2 text-gray-700 font-bold">Display in breaches list</span>
                        </label>
                        @error('display_in_breach_list')
                        <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white font-bold rounded-md">Save Area</button>
                </form>
            </div>
        </div>

        <div class="mt-6 bg-white rounded-md shadow p-4">
            <h2 class="text-xl font-bold mb-4">Saved Areas</h2>
            @include('component.search-areas')
        </div>
    </div>
@endsection
