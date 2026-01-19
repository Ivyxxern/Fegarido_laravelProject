<?php

namespace App\Http\Controllers;

use App\Models\Bike;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\PDF as DomPDF;

class BikeController extends Controller
{
    public function index(Request $request)
    {
        $query = Bike::with('bikeCategory')->latest();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('bike_name', 'like', "%{$search}%")
                  ->orWhere('model', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('bike_category_id', $request->category);
        }

        $bikes = $query->get();
        $totalBikes = Bike::count();
        $availableBikes = Bike::where('status', 'available')->count();
        $bikeCategories = \App\Models\BikeCategory::all();

        // Preserve search and filter values for the form
        $searchValue = $request->search ?? '';
        $categoryFilter = $request->category ?? '';

        return view('dashboard', compact('bikes', 'totalBikes', 'availableBikes', 'bikeCategories', 'searchValue', 'categoryFilter'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bike_name' => 'required|string|max:255',
            'model' => 'nullable|string|max:255',
            'price_per_day' => 'nullable|numeric|min:0',
            'status' => 'required|in:available,rented,maintenance',
            'bike_category_id' => 'nullable|exists:bike_categories,id',
            'photo' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $data = [
            'bike_name' => $request->bike_name,
            'model' => $request->model,
            'price_per_day' => $request->price_per_day ?? 0,
            'status' => $request->status,
            'bike_category_id' => $request->bike_category_id,
        ];

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $photoName = time() . '_' . $photo->getClientOriginalName();
            $photoPath = $photo->storeAs('bikes', $photoName, 'public');
            $data['photo'] = $photoPath;
        }

        Bike::create($data);

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
            'photo' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        $data = [
            'bike_name' => $request->bike_name,
            'model' => $request->model,
            'price_per_day' => $request->price_per_day ?? 0,
            'status' => $request->status,
            'bike_category_id' => $request->bike_category_id,
        ];

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($bike->photo && Storage::disk('public')->exists($bike->photo)) {
                Storage::disk('public')->delete($bike->photo);
            }
            
            $photo = $request->file('photo');
            $photoName = time() . '_' . $photo->getClientOriginalName();
            $photoPath = $photo->storeAs('bikes', $photoName, 'public');
            $data['photo'] = $photoPath;
        }

        $bike->update($data);

        return redirect()->back()->with('success', 'Bike updated successfully!');
    }

    public function destroy(Bike $bike)
    {
        $bike->delete(); // This will soft delete

        return redirect()->back()->with('success', 'Bike moved to trash successfully!');
    }

    public function trash(Request $request)
    {
        $query = Bike::onlyTrashed()->with('bikeCategory')->latest('deleted_at');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('bike_name', 'like', "%{$search}%")
                  ->orWhere('model', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('bike_category_id', $request->category);
        }

        $trashedBikes = $query->get();
        $bikeCategories = \App\Models\BikeCategory::all();

        // Preserve search and filter values for the form
        $searchValue = $request->search ?? '';
        $categoryFilter = $request->category ?? '';

        return view('trash', compact('trashedBikes', 'bikeCategories', 'searchValue', 'categoryFilter'));
    }

    public function restore($id)
    {
        $bike = Bike::onlyTrashed()->findOrFail($id);
        $bike->restore();

        return redirect()->route('trash')->with('success', 'Bike restored successfully!');
    }

    public function forceDelete($id)
    {
        $bike = Bike::onlyTrashed()->findOrFail($id);
        
        // Delete photo if exists
        if ($bike->photo && Storage::disk('public')->exists($bike->photo)) {
            Storage::disk('public')->delete($bike->photo);
        }
        
        $bike->forceDelete();

        return redirect()->route('trash')->with('success', 'Bike permanently deleted!');
    }

    public function exportPdf(Request $request)
    {
        try {
            $query = Bike::with('bikeCategory')->latest();

            // Apply search filter
            if ($request->filled('search')) {
                $search = $request->search;
                $query->where(function($q) use ($search) {
                    $q->where('bike_name', 'like', "%{$search}%")
                      ->orWhere('model', 'like', "%{$search}%");
                });
            }

            // Apply category filter
            if ($request->filled('category')) {
                $query->where('bike_category_id', $request->category);
            }

            $bikes = $query->get();
            
            $filename = 'bikes_' . date('Y-m-d_His') . '.pdf';
            
            $pdf = app('dompdf.wrapper');
            $pdf->loadView('exports.bikes-pdf', compact('bikes'));
            $pdf->setPaper('A4', 'landscape');
            
            return $pdf->download($filename);
        } catch (\Exception $e) {
            \Log::error('PDF Export Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to export PDF: ' . $e->getMessage());
        }
    }
}
