<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

// Public
Route::get('/', [PropertyController::class, 'landing'])->name('landing');
Route::get('/properties', [PropertyController::class, 'index'])->name('properties.index');
Route::get('/properties/{property}', [PropertyController::class, 'show'])->name('properties.show');
Route::post('/locale/{locale}', [LocaleController::class, 'switch'])->name('locale.switch');

// Calendar AJAX (public)
Route::get('/api/properties/{property}/calendar/{year}/{month}', [BookingController::class, 'calendar'])->name('calendar');

// Booking (requires auth)
Route::middleware('auth')->group(function () {
    Route::get('/booking/{property}', [BookingController::class, 'create'])->name('booking.create');
    Route::post('/booking/{property}', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/booking/{booking}/confirmation', [BookingController::class, 'confirmation'])->name('booking.confirmation');
    Route::get('/booking/{booking}/pdf', [BookingController::class, 'downloadPdf'])->name('booking.pdf');
});

// Guest dashboard
Route::middleware(['auth', 'verified'])->prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('index');
    Route::get('/bookings', [DashboardController::class, 'bookings'])->name('bookings');
    Route::get('/bookings/{booking}', [DashboardController::class, 'showBooking'])->name('bookings.show');
    Route::post('/bookings/{booking}/cancel', [DashboardController::class, 'cancelBooking'])->name('bookings.cancel');
    Route::post('/bookings/{booking}/review', [ReviewController::class, 'store'])->name('reviews.store');
});

// Keep old dashboard route for Breeze compatibility
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

// Admin
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('properties', Admin\PropertyController::class);
    Route::post('properties/{property}/photos', [Admin\PhotoController::class, 'store'])->name('properties.photos.store');
    Route::delete('photos/{photo}', [Admin\PhotoController::class, 'destroy'])->name('photos.destroy');
    Route::resource('bookings', Admin\BookingController::class)->only(['index', 'show', 'update']);
    Route::post('bookings/{booking}/status', [Admin\BookingController::class, 'updateStatus'])->name('bookings.status');
    Route::post('bookings/{booking}/confirm-payment', [Admin\BookingController::class, 'confirmPayment'])->name('bookings.confirm-payment');
    Route::resource('blocked-dates', Admin\BlockedDateController::class)->only(['index', 'store', 'destroy']);
});

// Profile (Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
