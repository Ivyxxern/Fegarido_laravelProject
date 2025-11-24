<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\BikeController;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/dashboard', [StudentController::class, 'index'])->name('dashboard');
Route::post('/students', [StudentController::class, 'store'])->name('students.store');

Route::middleware('auth')->group(function () {
    Route::get('/bikes', [BikeController::class, 'index'])->name('bikes.index');
    Route::post('/bikes', [BikeController::class, 'store']);
    Route::put('/bikes/{bike}', [BikeController::class, 'update']);
    Route::delete('/bikes/{bike}', [BikeController::class, 'destroy']);

    Route::get('/brands', [BrandController::class, 'index'])->name('brands.index');
    Route::post('/brands', [BrandController::class, 'store'])->name('brands.store');
    Route::put('/brands/{brand}', [BrandController::class, 'update'])->name('brands.update');
    Route::delete('/brands/{brand}', [BrandController::class, 'destroy'])->name('brands.destroy');

});


require __DIR__.'/auth.php';
