<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Property;
use App\Services\BookingService;
use App\Services\CalendarService;
use App\Services\PricingService;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function calendar(Property $property, int $year, int $month, CalendarService $calendarService)
    {
        $monthStart = sprintf('%04d-%02d-01', $year, $month);
        $monthEnd = date('Y-m-t', strtotime($monthStart));

        $occupied = $calendarService->getOccupiedDates($property->id, $monthStart, $monthEnd);

        return response()->json(['occupied' => $occupied]);
    }

    public function create(Property $property, PricingService $pricing)
    {
        return view('pages.booking.create', [
            'property' => $property,
            'config' => config('solstay'),
        ]);
    }

    public function store(Request $request, Property $property, BookingService $bookingService)
    {
        $validated = $request->validate([
            'check_in' => 'required|date|after:today',
            'check_out' => 'required|date|after:check_in',
            'guests' => 'required|integer|min:1|max:' . $property->max_guests,
            'guest_name' => 'required|string|max:255',
            'guest_phone' => 'required|string|max:50',
            'guest_email' => 'nullable|email|max:255',
            'payment_method' => 'required|in:transfer,bizum',
            'notes' => 'nullable|string|max:1000',
        ]);

        try {
            $booking = $bookingService->create($property, $request->user(), $validated);

            return redirect()->route('booking.confirmation', $booking);
        } catch (\RuntimeException $e) {
            return back()->withErrors(['check_in' => __('Las fechas seleccionadas ya no están disponibles.')])->withInput();
        }
    }

    public function confirmation(Booking $booking)
    {
        $this->authorize('view', $booking);
        $booking->load('property');

        return view('pages.booking.confirmation', compact('booking'));
    }

    public function downloadPdf(Booking $booking)
    {
        $this->authorize('view', $booking);
        $booking->load('property');

        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pages.booking.pdf', compact('booking'));

        return $pdf->download("solstay-reserva-{$booking->id}.pdf");
    }
}
