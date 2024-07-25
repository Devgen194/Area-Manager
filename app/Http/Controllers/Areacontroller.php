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
        return view('components.area', compact('categories', 'areas'));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'coordinates' => 'nullable|json',
                'geojsonFile' => 'nullable|file|mimes:json',
                'start_date' => 'required|date',
                'end_date' => 'nullable|date|after_or_equal:start_date',
                'category_id' => 'required|exists:categories,id',
                'display_in_breach_list' => 'nullable|sometimes|boolean',
            ]);

            // Check if GeoJSON file is present and extract coordinates
            if ($request->hasFile('geojsonFile')) {
                $geojson = json_decode(file_get_contents($request->file('geojsonFile')->getRealPath()), true);
                if (isset($geojson['geometry']['coordinates'])) {
                    $data['coordinates'] = json_encode($geojson['geometry']['coordinates']);
                }
            }

            // If coordinates are still not set, use the coordinates from the request
            if (!isset($data['coordinates']) || empty($data['coordinates'])) {
                $data['coordinates'] = $request->input('coordinates');
            }

            Area::create($data);

            return redirect()->route('areas.index')->with('success', 'Area created successfully.');
        } catch (\Exception $e) {
            Log::error('Failed to create area: '.$e->getMessage());

            return redirect()->back()->withInput()->withErrors(['error' => 'An error occurred while creating the area.']);
        }
    }
}
