<?php

namespace App\Http\Controllers;

use App\Models\VehiclesDetail;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data=VehiclesDetail::all()->where('user_id',auth()->user()->id);
        $total_view=0;
        foreach($data as $item){
            $total_view+=$item->views;
        }
        $total_sold=0;
        foreach($data as $item){
            if($item->status=='sold'){
                $total_sold++;
            }
        }
        $recent_listings = VehiclesDetail::where('user_id', auth()->user()->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
        return view('dashboard', compact('data', 'total_view', 'total_sold', 'recent_listings'));
    }
}
