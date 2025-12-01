<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        // Load all brands with bike count
        $brands = Brand::withCount('bikes')->get();

        // If any brand has 0 bikes, automatically add 5 bikes
        foreach ($brands as $brand) {
            if ($brand->bikes_count == 0) {
                for ($i = 1; $i <= 5; $i++) {
                    $brand->bikes()->create([
                        'bike_name' => $brand->brand_name . ' Bike ' . $i,
                        'is_rented' => 0
                    ]);
                }
            }
        }

        // Reload brands with updated bike count
        $brands = Brand::withCount('bikes')->get();

        return view('brands.index', compact('brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|string|max:255'
        ]);

        // Create brand
        $brand = Brand::create($request->only('brand_name'));

        // Add 5 bikes automatically
        for ($i = 1; $i <= 5; $i++) {
            $brand->bikes()->create([
                'bike_name' => $brand->brand_name . ' Bike ' . $i,
                'is_rented' => 0
            ]);
        }

        return back()->with('success', 'Brand added successfully with 5 bikes!');
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'brand_name' => 'required|string|max:255'
        ]);

        $brand->update($request->only('brand_name'));

        return back()->with('success', 'Brand updated successfully!');
    }

    public function destroy(Brand $brand)
    {
        // Delete all bikes first
        $brand->bikes()->delete();

        // Then delete brand
        $brand->delete();

        return back()->with('success', 'Brand deleted successfully!');
    }
}
