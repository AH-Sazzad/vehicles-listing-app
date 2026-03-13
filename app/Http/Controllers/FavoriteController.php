<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorefavoriteRequest;
use App\Http\Requests\UpdatefavoriteRequest;
use App\Models\Favorite;
use App\Models\VehiclesDetail;
use Symfony\Component\HttpFoundation\Request;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $userId = auth()->id();

    $favorites = Favorite::with('vehicle')->where('user_id', $userId)->get();

    $totalValue = $favorites->sum(fn($favorite) => $favorite->vehicle->price);
    // $vehicles = VehiclesDetail::where('id', $favorites->pluck('vehicle_id'))->get();

    $still_Available = $favorites->pluck('vehicle')->where('status', 'available')->count();

    return view('favorite', compact('favorites', 'totalValue', 'still_Available'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorefavoriteRequest $request)
    {
        

        $userId = auth()->id();
        $vehicleId = $request->input('vehicle_id');

        // Check if the favorite already exists for this user and vehicle
        $existingFavorite = Favorite::where('user_id', $userId)
                                    ->where('vehicle_id', $vehicleId)
                                    ->first();

        if ($existingFavorite) {
            return redirect()->back()->with('message', 'This vehicle is already in your favorites.');
        }

        // Create a new favorite entry
        Favorite::create([
            'user_id' => $userId,
            'vehicle_id' => $vehicleId,
        ]);

        return redirect()->back()->with('message', 'Vehicle added to favorites successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(favorite $favorite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(favorite $favorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatefavoriteRequest $request, favorite $favorite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $userId = auth()->id();
        $vehicleId = $request->input('vehicle_id');

        $favorite = Favorite::where('user_id', $userId)
                            ->where('vehicle_id', $vehicleId)
                            ->first();

        if ($favorite) {
            $favorite->delete();
        }

        return redirect()->back()->with('message', 'Vehicle removed from favorites.');
    }
   public function remove(Request $request)
{
    $userId = auth()->id();
    
    Favorite::where('user_id', $userId)->delete();

    return redirect()->back()->with('message', 'Vehicles removed from favorites.');
}
}
