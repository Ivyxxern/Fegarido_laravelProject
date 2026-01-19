<?php

namespace App\Http\Controllers;

use App\Models\BikeCategory;
use Illuminate\Http\Request;

class BikeCategoryController extends Controller
{
    public function index()
    {
        $categories = BikeCategory::withCount('bikes')->latest()->get();
        return view('bike-categories', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:bike_categories,name',
        ]);

        BikeCategory::create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Bike category added successfully!');
    }

    public function update(Request $request, BikeCategory $bikeCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:bike_categories,name,' . $bikeCategory->id,
        ]);

        $bikeCategory->update([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Bike category updated successfully!');
    }

    public function destroy(BikeCategory $bikeCategory)
    {
        $bikeCategory->delete();
        return redirect()->back()->with('success', 'Bike category deleted successfully!');
    }
}
