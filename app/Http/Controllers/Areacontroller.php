<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AreaController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $areas = Area::with('category')->get();
        return view('component.area', compact('categories', 'areas'));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'coordinates' => 'required|json',
                'start_date' => 'required|date',
                'end_date' => 'nullable|date|after_or_equal:start_date',
                'category_id' => 'required|exists:categories,id',
                'display_in_breach_list' => 'nullable|sometimes|boolean',
            ]);

            Area::create($data);

            return redirect()->route('areas.index')->with('success', 'Area created successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to create area: '.$e->getMessage());

            return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred while creating the area.']);
        }
    }
}
