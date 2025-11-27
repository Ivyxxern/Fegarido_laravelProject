<?php
use Illuminate\Support\Facades\DB;

Route::get('/available-bikes', function () {
    return DB::table('brands')->count();
});


