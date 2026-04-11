<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BookingStatus;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with('property', 'user')->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('property_id')) {
            $query->where('property_id', $request->property_id);
        }

        $bookings = $query->paginate(15);

        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $booking->load('property', 'user');

        return view('admin.bookings.show', compact('booking'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $validated = $request->validate([
            'status' => 'required|in:' . implode(',', array_column(BookingStatus::cases(), 'value')),
        ]);

        $booking->update(['status' => $validated['status']]);

        return back()->with('success', 'Estado actualizado.');
    }

    public function confirmPayment(Booking $booking)
    {
        $booking->update([
            'payment_confirmed' => true,
            'status' => BookingStatus::Confirmed,
        ]);

        return back()->with('success', 'Pago confirmado y reserva activada.');
    }
}
