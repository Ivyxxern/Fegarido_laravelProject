<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use Illuminate\Http\Request;

class BikeController extends Controller
{
    public function index()
    {
        $bikes = Bike::with('bikeCategory')->latest()->get();
        $totalBikes = Bike::count();
        $availableBikes = Bike::where('status', 'available')->count();
        $bikeCategories = \App\Models\BikeCategory::all();

        return view('dashboard', compact('bikes', 'totalBikes', 'availableBikes', 'bikeCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bike_name' => 'required|string|max:255',
            'model' => 'nullable|string|max:255',
            'price_per_day' => 'nullable|numeric|min:0',
            'status' => 'required|in:available,rented,maintenance',
            'bike_category_id' => 'nullable|exists:bike_categories,id',
        ]);

        Bike::create([
            'bike_name' => $request->bike_name,
            'model' => $request->model,
            'price_per_day' => $request->price_per_day ?? 0,
            'status' => $request->status,
            'bike_category_id' => $request->bike_category_id,
        ]);

        return redirect()->back()->with('success', 'Bike added successfully!');
    }

    public function update(Request $request, Bike $bike)
    {
        $request->validate([
            'bike_name' => 'required|string|max:255',
            'model' => 'nullable|string|max:255',
            'price_per_day' => 'nullable|numeric|min:0',
            'status' => 'required|in:available,rented,maintenance',
            'bike_category_id' => 'nullable|exists:bike_categories,id',
        ]);

        $bike->update([
            'bike_name' => $request->bike_name,
            'model' => $request->model,
            'price_per_day' => $request->price_per_day ?? 0,
            'status' => $request->status,
            'bike_category_id' => $request->bike_category_id,
        ]);

        return redirect()->back()->with('success', 'Bike updated successfully!');
    }

    public function destroy(Bike $bike)
    {
        $bike->delete();

        return redirect()->back()->with('success', 'Bike deleted successfully!');
    }
}
