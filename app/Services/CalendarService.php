<?php

namespace App\Services;

use App\Models\BlockedDate;
use App\Models\Booking;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

class CalendarService
{
    public function getOccupiedDates(string $propertyId, string $monthStart, string $monthEnd): array
    {
        $bookings = Booking::where('property_id', $propertyId)
            ->where('status', '!=', 'cancelled')
            ->where('check_in', '<', $monthEnd)
            ->where('check_out', '>', $monthStart)
            ->get(['check_in', 'check_out']);

        $blocked = BlockedDate::where('property_id', $propertyId)
            ->where('date_from', '<', $monthEnd)
            ->where('date_to', '>', $monthStart)
            ->get(['date_from', 'date_to']);

        $dates = collect();

        foreach ($bookings as $booking) {
            $from = Carbon::parse(max($booking->check_in, $monthStart));
            $to = Carbon::parse(min($booking->check_out, $monthEnd))->subDay();
            foreach (CarbonPeriod::create($from, $to) as $date) {
                $dates->push($date->format('Y-m-d'));
            }
        }

        foreach ($blocked as $block) {
            $from = Carbon::parse(max($block->date_from, $monthStart));
            $to = Carbon::parse(min($block->date_to, $monthEnd))->subDay();
            foreach (CarbonPeriod::create($from, $to) as $date) {
                $dates->push($date->format('Y-m-d'));
            }
        }

        return $dates->unique()->values()->toArray();
    }
}
