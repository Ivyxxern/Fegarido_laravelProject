<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Brand;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        $brands = Brand::withCount('bikes')->get();

        return view('dashboard', [
            'students' => $students,
            'brands' => $brands,
            'totalRented' => $students->count(),
            'availableBikes' => max($brands->sum('bikes_count') - $students->count(), 0),
            'customerSatisfaction' => 100
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'select_bike' => 'required',
            'phone' => 'required'
        ]);

        Student::create($request->all());

        return back()->with('success', 'Successfully added new customer!');
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required',
            'location' => 'required',
            'select_bike' => 'required',
            'phone' => 'required'
        ]);

        $student->update($request->all());

        return back()->with('success', 'Customer updated.');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return back()->with('success', 'Customer deleted.');
    }
}
