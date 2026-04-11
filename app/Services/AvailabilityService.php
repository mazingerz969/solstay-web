<?php

namespace App\Services;

use App\Models\BlockedDate;
use App\Models\Booking;
use Carbon\Carbon;

class AvailabilityService
{
    public function isAvailable(string $propertyId, Carbon $checkIn, Carbon $checkOut, ?int $excludeBookingId = null): bool
    {
        $bookingConflict = Booking::where('property_id', $propertyId)
            ->where('status', '!=', 'cancelled')
            ->where('check_in', '<', $checkOut->toDateString())
            ->where('check_out', '>', $checkIn->toDateString())
            ->when($excludeBookingId, fn ($q) => $q->where('id', '!=', $excludeBookingId))
            ->exists();

        if ($bookingConflict) {
            return false;
        }

        return ! BlockedDate::where('property_id', $propertyId)
            ->where('date_from', '<', $checkOut->toDateString())
            ->where('date_to', '>', $checkIn->toDateString())
            ->exists();
    }
}
