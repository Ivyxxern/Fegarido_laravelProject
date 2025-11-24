<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class bike_controller extends Controller
{
    public function create()
{
    $bikes = Bike::all();
    return view('/dashboard', compact('bikes'));
}
}
