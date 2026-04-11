<?php

namespace Database\Seeders;

use App\Enums\BookingStatus;
use App\Enums\PaymentMethod;
use App\Models\Booking;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoBookingSeeder extends Seeder
{
    public function run(): void
    {
        $maria = User::where('email', 'maria@example.com')->first();

        // Completed booking with review
        $completed = Booking::create([
            'property_id' => 'costa-del-sol',
            'user_id' => $maria->id,
            'check_in' => now()->subDays(20),
            'check_out' => now()->subDays(15),
            'nights' => 5,
            'guests' => 2,
            'total_price' => 42500,
            'status' => BookingStatus::Completed,
            'payment_method' => PaymentMethod::Bizum,
            'payment_confirmed' => true,
            'guest_name' => 'María García',
            'guest_phone' => '+34 655 123 456',
            'guest_email' => 'maria@example.com',
        ]);

        Review::create([
            'booking_id' => $completed->id,
            'user_id' => $maria->id,
            'property_id' => 'costa-del-sol',
            'rating' => 5,
            'comment' => 'Apartamento increíble, justo en la playa. Todo impecable y el check-in fue muy fácil. Volveremos seguro.',
            'approved' => true,
        ]);

        // Upcoming confirmed booking
        Booking::create([
            'property_id' => 'sierra-nevada',
            'user_id' => $maria->id,
            'check_in' => now()->addDays(10),
            'check_out' => now()->addDays(14),
            'nights' => 4,
            'guests' => 4,
            'total_price' => 48000,
            'status' => BookingStatus::Confirmed,
            'payment_method' => PaymentMethod::Transfer,
            'payment_confirmed' => true,
            'guest_name' => 'María García',
            'guest_phone' => '+34 655 123 456',
            'guest_email' => 'maria@example.com',
            'notes' => 'Llegaremos sobre las 18:00. Llevamos un perro pequeño.',
        ]);

        // Pending booking
        Booking::create([
            'property_id' => 'costa-del-sol',
            'user_id' => $maria->id,
            'check_in' => now()->addDays(30),
            'check_out' => now()->addDays(37),
            'nights' => 7,
            'guests' => 3,
            'total_price' => 59500,
            'status' => BookingStatus::Pending,
            'payment_method' => PaymentMethod::Transfer,
            'guest_name' => 'María García',
            'guest_phone' => '+34 655 123 456',
            'guest_email' => 'maria@example.com',
        ]);
    }
}
