<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use Illuminate\Http\Request;

class BikeController extends Controller
{
    public function index()
    {
        $bikes = Bike::all();

        return view('dashboard', [
            'bikes' => $bikes,
            'customers' => $bikes->whereNotNull('customer_name'),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required',
            'bike_name' => 'required',
            'phone' => 'required',
            'address' => 'required',
        ]);

        Bike::create([
            'bike_name' => $request->bike_name,
            'customer_name' => $request->customer_name,
            'phone' => $request->phone,
            'address' => $request->address,
            'is_rented' => true,
        ]);

        return redirect()->back()->with('success', 'Customer added successfully!');
    }

    public function update(Request $request, Bike $bike)
    {
        $bike->update($request->only([
            'bike_name',
            'customer_name',
            'phone',
            'address',
            'is_rented',
        ]));

        return redirect()->back()->with('success', 'Updated successfully!');
    }

    public function destroy(Bike $bike)
    {
        $bike->delete();

        return redirect()->back()->with('success', 'Deleted successfully!');
    }
}
