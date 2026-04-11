<?php

namespace App\Http\Controllers;

use App\Enums\BookingStatus;
use App\Models\Booking;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $bookings = $request->user()->bookings()
            ->with('property')
            ->latest()
            ->get();

        $upcoming = $bookings->filter(fn ($b) => $b->status !== BookingStatus::Cancelled && $b->check_in->isFuture());

        return view('dashboard.index', compact('bookings', 'upcoming'));
    }

    public function bookings(Request $request)
    {
        $bookings = $request->user()->bookings()
            ->with('property')
            ->latest()
            ->paginate(10);

        return view('dashboard.bookings.index', compact('bookings'));
    }

    public function showBooking(Booking $booking)
    {
        $this->authorize('view', $booking);
        $booking->load('property');

        return view('dashboard.bookings.show', compact('booking'));
    }

    public function cancelBooking(Booking $booking)
    {
        $this->authorize('cancel', $booking);

        $booking->update(['status' => BookingStatus::Cancelled]);

        return back()->with('success', __('Reserva cancelada correctamente.'));
    }
}
