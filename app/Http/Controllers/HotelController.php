<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Hotel::paginate(15);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'description' => 'nullable|string',
            'stars' => 'nullable|integer',
        ]);

        return Hotel::create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Hotel $hotel)
    {
        return $hotel;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hotel $hotel)
    {
        $data = $request->validate([
            'name' => 'sometimes|string',
            'address' => 'nullable|string',
            'city' => 'nullable|string',
            'description' => 'nullable|string',
            'stars' => 'nullable|integer',
        ]);

        $hotel->update($data);
        return $hotel;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hotel $hotel)
    {
        $hotel->delete();

        return response()->json([
            'message' => 'Отель удалён'
        ], 200);
    }
}
