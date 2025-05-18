<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Booking::with('hotel')->paginate(15);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'hotel_id' => 'required|exists:hotels,id',
            'guest_name' => 'required|string',
            'guest_email' => 'nullable|email',
            'check_in' => 'required|date',
            'check_out' => 'required|date|after_or_equal:check_in',
            'guests' => 'integer|min:1',
        ]);

        return Booking::create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        return $booking->load('hotel');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $data = $request->validate([
            'hotel_id' => 'sometimes|exists:hotels,id',
            'guest_name' => 'sometimes|string',
            'guest_email' => 'nullable|email',
            'check_in' => 'sometimes|date',
            'check_out' => 'sometimes|date|after_or_equal:check_in',
            'guests' => 'sometimes|integer|min:1',
        ]);

        $booking->update($data);
        return $booking->load('hotel');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return response()->json([
            'message' => 'Бронь удалёна'
        ], 200);
    }
}
