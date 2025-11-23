<?php

namespace App\Http\Controllers;

use App\Models\Brand; 
use Illuminate\Http\Request;

class BikeController extends Controller
{
    public function index()
    {
        return view('brands.index', [
            'brands' => Brand::withCount('bikes')->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(['brand_name' => 'required']);
        Brand::create($request->except('xall'));
        return back()->with('success', 'Brand added');
    }

    public function update(Request $request, Brand $brand)
    {
        $request->validate(['brand_name' => 'required']);
        $brand->update($request->all());
        return back()->with('success', 'Brand updated');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return back()->with('success', 'Brand deleted');
    }
}

