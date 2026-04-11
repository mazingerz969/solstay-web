<?php

namespace App\Models;

use App\Enums\BookingStatus;
use App\Enums\PaymentMethod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id', 'user_id', 'check_in', 'check_out', 'nights',
        'guests', 'total_price', 'status', 'payment_method',
        'payment_reference', 'payment_confirmed', 'guest_name',
        'guest_phone', 'guest_email', 'notes',
    ];

    protected function casts(): array
    {
        return [
            'check_in' => 'date',
            'check_out' => 'date',
            'payment_confirmed' => 'boolean',
            'status' => BookingStatus::class,
            'payment_method' => PaymentMethod::class,
        ];
    }

    // Relationships

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Accessors

    public function getFormattedTotalAttribute(): string
    {
        $symbol = config('solstay.business.currency_symbol', '€');
        return $symbol . number_format($this->total_price / 100, 2);
    }

    public function getDepositAttribute(): int
    {
        $percent = config('solstay.booking.deposit_percent', 30);
        return (int) round($this->total_price * $percent / 100);
    }

    public function getFormattedDepositAttribute(): string
    {
        $symbol = config('solstay.business.currency_symbol', '€');
        return $symbol . number_format($this->deposit / 100, 2);
    }

    // Scopes

    public function scopeActive($query)
    {
        return $query->whereNotIn('status', [BookingStatus::Cancelled, BookingStatus::Completed]);
    }

    public function scopeUpcoming($query)
    {
        return $query->where('check_in', '>=', now()->toDateString())
            ->where('status', '!=', BookingStatus::Cancelled);
    }

    public function scopePending($query)
    {
        return $query->where('status', BookingStatus::Pending);
    }

    // Helpers

    public function canBeCancelled(): bool
    {
        if ($this->status === BookingStatus::Cancelled || $this->status === BookingStatus::Completed) {
            return false;
        }

        $hours = config('solstay.booking.cancellation_hours', 48);
        return $this->check_in->diffInHours(now()) >= $hours;
    }
}
