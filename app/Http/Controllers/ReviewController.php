<?php

namespace App\Http\Controllers;

use App\Enums\BookingStatus;
use App\Models\Booking;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Booking $booking)
    {
        $this->authorize('view', $booking);

        if ($booking->status !== BookingStatus::Completed) {
            abort(403);
        }

        if (Review::where('booking_id', $booking->id)->exists()) {
            return back()->withErrors(['review' => __('Ya has dejado una reseña para esta reserva.')]);
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        Review::create([
            'booking_id' => $booking->id,
            'user_id' => $request->user()->id,
            'property_id' => $booking->property_id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return back()->with('success', __('Gracias por tu reseña.'));
    }
}
