<?php

namespace App\Services;

use App\Enums\BookingStatus;
use App\Models\Booking;
use App\Models\Property;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BookingService
{
    public function __construct(
        private AvailabilityService $availability,
        private PricingService $pricing,
    ) {}

    public function create(Property $property, User $user, array $data): Booking
    {
        return DB::transaction(function () use ($property, $user, $data) {
            $checkIn = Carbon::parse($data['check_in']);
            $checkOut = Carbon::parse($data['check_out']);

            if (! $this->availability->isAvailable($property->id, $checkIn, $checkOut)) {
                throw new \RuntimeException('DATES_UNAVAILABLE');
            }

            $nights = $checkIn->diffInDays($checkOut);
            $totalPrice = $this->pricing->calculateTotal($property, $nights);

            return Booking::create([
                'property_id' => $property->id,
                'user_id' => $user->id,
                'check_in' => $checkIn,
                'check_out' => $checkOut,
                'nights' => $nights,
                'guests' => $data['guests'],
                'total_price' => $totalPrice,
                'status' => BookingStatus::Pending,
                'payment_method' => $data['payment_method'],
                'guest_name' => $data['guest_name'],
                'guest_phone' => $data['guest_phone'],
                'guest_email' => $data['guest_email'] ?? null,
                'notes' => $data['notes'] ?? null,
            ]);
        });
    }
}
