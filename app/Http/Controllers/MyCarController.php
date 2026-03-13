<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyCarController extends Controller
{
    public function index()
    {   
        
        
        $vehicles = auth()->user()->vehicles()->paginate(15);
        $totalVehicles = auth()->user()->vehicles()->count();
        return view('my_cars', compact('vehicles', 'totalVehicles'));
    }
}
