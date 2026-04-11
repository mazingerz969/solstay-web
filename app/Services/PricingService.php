<?php

namespace App\Services;

use App\Models\Property;

class PricingService
{
    public function calculateTotal(Property $property, int $nights): int
    {
        return $property->price_per_night * $nights;
    }

    public function calculateDeposit(int $totalPrice): int
    {
        $percent = config('solstay.booking.deposit_percent', 30);

        return (int) round($totalPrice * $percent / 100);
    }
}
