<?php

namespace App\Http\Controllers\Admin;

use App\Enums\BookingStatus;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Property;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBookings = Booking::count();
        $pendingBookings = Booking::where('status', BookingStatus::Pending)->count();
        $confirmedBookings = Booking::where('status', BookingStatus::Confirmed)->count();
        $totalRevenue = Booking::whereIn('status', [BookingStatus::Confirmed, BookingStatus::CheckedIn, BookingStatus::Completed])
            ->sum('total_price');
        $properties = Property::count();

        $recentBookings = Booking::with('property', 'user')
            ->latest()
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalBookings', 'pendingBookings', 'confirmedBookings',
            'totalRevenue', 'properties', 'recentBookings'
        ));
    }
}
