<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\VehiclesDetail;
use App\Models\Image;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Display the home page.
     */
    public function index(): View
    {
        $vehicles = VehiclesDetail::with('images')->paginate(51);
        $totalVehicles = VehiclesDetail::count();
        return view('Home', compact('vehicles', 'totalVehicles'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'category_id' => 'required|exists:categories,id',
            'condition' => 'required|in:new,used',
            'price' => 'required|numeric|min:0',
            'mileage' => 'nullable|integer|min:0',
            'fuel_type' => 'required|string',
            'transmission' => 'required|string',
            'body_type' => 'nullable|string',
            'color' => 'nullable|string',
            'engine_capacity' => 'nullable|string',
            'location' => 'required|string',
            'featured' => 'nullable|boolean',
            'status' => 'required|in:available,sold',
            'description' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['slug'] = \Str::slug($validated['title'] . '-' . uniqid());
        $validated['featured'] = $request->has('featured');

        $vehicle = VehiclesDetail::create($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                $path = $image->store('vehicles', 'public');
                
                Image::create([
                    'vehicle_id' => $vehicle->id,
                    'image_path' => $path,
                    'is_featured' => $index === 0,
                ]);
            }
        }
        

        return redirect()->route('dashboard')->with('success', 'Vehicle listing created successfully.');
    }
}
