<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\BikeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Home page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// FIX: Logout route so sidebar no longer breaks
Route::post('/logout', function () {
    Auth::logout();
    return redirect('/');
})->name('logout');


// Auth-protected routes
Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [StudentController::class, 'index'])->name('dashboard');

    // --- Students (Customers) ---
    Route::post('/students', [StudentController::class, 'store'])->name('students.store');
    Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');
    Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');

    // --- Bikes ---
    Route::get('/bikes', [BikeController::class, 'index'])->name('bikes.index');
    Route::post('/bikes', [BikeController::class, 'store'])->name('bikes.store');
    Route::put('/bikes/{bike}', [BikeController::class, 'update'])->name('bikes.update');
    Route::delete('/bikes/{bike}', [BikeController::class, 'destroy'])->name('bikes.destroy');

    // --- Brands ---
    Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
    Route::post('/brands', [BrandController::class, 'store'])->name('brands.store');
    Route::put('/brands/{brand}', [BrandController::class, 'update'])->name('brands.update');
    Route::delete('/brands/{brand}', [BrandController::class, 'destroy'])->name('brands.destroy');

});
