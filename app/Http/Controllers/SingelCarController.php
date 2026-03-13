<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VehiclesDetail;
use Illuminate\Http\Request;

class SingelCarController extends Controller
{
    public function index($slug)
    
    {   $vehicle = VehiclesDetail::with('images')->where('slug', $slug)->firstOrFail();
        $similarVehicles = VehiclesDetail::with('images')->where('category_id', $vehicle->category_id)
            ->where('id', '!=', $vehicle->id)
            ->take(3)
            ->get();
        $user=User::where('id',$vehicle->user_id)->first();
        $vehicle->increment('views');
        return view('singelCar', compact('vehicle','user','similarVehicles'));
    }
}
