<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Brand;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        // Load all students
        $students = Student::all();

        // Load all brands WITH bikes count
        $brands = Brand::withCount('bikes')->get();

        // Total rented bikes = number of students
        $totalRented = $students->count();

        // Total bikes = sum of bikes_count from brands
        $totalBikes = $brands->sum('bikes_count');

        // Available bikes = total bikes - rented bikes
        $availableBikes = max($totalBikes - $totalRented, 0);

        // Customer satisfaction placeholder
        $customerSatisfaction = 100;

        return view('dashboard', compact(
            'students',
            'brands',
            'totalRented',
            'availableBikes',
            'customerSatisfaction'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
            'select_bike' => 'required|string',
            'phone' => 'required|string'
        ]);

        Student::create($request->all());

        return back()->with('success', 'Successfully added new customer!');
    }

    public function update(Request $request, Student $student)
    {
        $student->update($request->all());

        return back()->with('success', 'Customer updated.');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return back()->with('success', 'Customer deleted.');
    }
}
