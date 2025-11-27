<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::withCount('bikes')->get();
          $brands->each(function($brand) {
            $brand->bike_count = 5;
        });
        return view('brands.index', compact('brands'));

        $brands->each(function($brand) {
            $brand->bike_count = 5;
        });
    }

    public function store(Request $request)
    {   
        $request->validate([
            'brand_name' => 'required'
        ]);

        Brand::create([
            'brand_name' => $request->brand_name
        ]);

        return back()->with('success', 'Brand added');
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'brand_name' => 'required'
        ]);

        $brand->update([
            'brand_name' => $request->brand_name
        ]);

        return back()->with('success', 'Brand updated successfully.');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return back()->with('success', 'Brand deleted');
    }
}
