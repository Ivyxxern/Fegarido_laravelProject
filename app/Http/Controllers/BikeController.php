<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use App\Models\Brand;
use Illuminate\Http\Request;

class BikeController extends Controller
{
    public function index()
    {
        $bikes = Bike::with('brand')->get();
        $brands = Brand::all();
        return view('bikes.index', compact('bikes', 'brands'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'bike_name' => 'required|string|max:255'
        ]);

        Bike::create($request->only('brand_id', 'bike_name'));

        return back()->with('success', 'Bike added successfully!');
    }

    public function update(Request $request, Bike $bike)
    {
        $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'bike_name' => 'required|string|max:255'
        ]);

        $bike->update($request->only('brand_id', 'bike_name'));

        return back()->with('success', 'Bike updated successfully!');
    }

    public function destroy(Bike $bike)
    {
        $bike->delete();

        return back()->with('success', 'Bike deleted successfully!');
    }
}
