<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::latest()->get();

        return view('dashboard', compact('students'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'select_bike' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        Student::create($validated);

        return redirect()
            ->back()
            ->with('success', 'Successfully added new customer!');
    }

    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'select_bike' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
        ]);

        $student->update($validated);

        return redirect()
            ->back()
            ->with('success', 'Customer updated successfully!');
    }

    public function destroy(Student $student)
    {
        $student->delete();

        return redirect()
            ->back()
            ->with('success', 'Customer deleted successfully!');
    }
}
