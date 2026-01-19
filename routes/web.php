<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\BikeController;
use App\Http\Controllers\BikeCategoryController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;

// Home page
Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [BikeController::class, 'index'])->name('dashboard');

    // Bike CRUD
    Route::post('/bikes', [BikeController::class, 'store'])->name('bikes.store');
    Route::put('/bikes/{bike}', [BikeController::class, 'update'])->name('bikes.update');
    Route::delete('/bikes/{bike}', [BikeController::class, 'destroy'])->name('bikes.destroy');

    // Trash Management
    Route::get('/trash', [BikeController::class, 'trash'])->name('trash');
    Route::post('/bikes/{id}/restore', [BikeController::class, 'restore'])->name('bikes.restore');
    Route::delete('/bikes/{id}/force-delete', [BikeController::class, 'forceDelete'])->name('bikes.force-delete');

    // PDF Export
    Route::get('/bikes/export-pdf', [BikeController::class, 'exportPdf'])->name('bikes.export-pdf');

    // Bike Categories
    Route::get('/bike-categories', [BikeCategoryController::class, 'index'])->name('bike-categories.index');
    Route::post('/bike-categories', [BikeCategoryController::class, 'store'])->name('bike-categories.store');
    Route::put('/bike-categories/{bikeCategory}', [BikeCategoryController::class, 'update'])->name('bike-categories.update');
    Route::delete('/bike-categories/{bikeCategory}', [BikeCategoryController::class, 'destroy'])->name('bike-categories.destroy');

    // Settings
    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

// Image serving route (fallback if symlink doesn't work on Windows)
Route::get('/storage/{path}', function ($path) {
    $filePath = storage_path('app/public/' . $path);
    
    if (!file_exists($filePath)) {
        abort(404);
    }
    
    $file = file_get_contents($filePath);
    $type = mime_content_type($filePath);
    
    return response($file, 200)->header('Content-Type', $type);
})->where('path', '.*');

require __DIR__ . '/auth.php';
