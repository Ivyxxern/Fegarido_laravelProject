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

require __DIR__ . '/auth.php';
