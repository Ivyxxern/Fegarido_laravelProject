<?php

use Illuminate\Support\Facades\Route; 
use App\Http\Controllers\BikeController;
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

    // Customer CRUD (still using Bike model/controller)
    Route::post('/bikes', [BikeController::class, 'store'])->name('bikes.store');
    Route::put('/bikes/{bike}', [BikeController::class, 'update'])->name('bikes.update');
    Route::delete('/bikes/{bike}', [BikeController::class, 'destroy'])->name('bikes.destroy');

    // Settings
    Route::redirect('settings', 'settings/profile');
    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__ . '/auth.php';
