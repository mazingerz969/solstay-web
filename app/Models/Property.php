<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'id', 'name_es', 'name_en', 'description_es', 'description_en',
        'address', 'location_lat', 'location_lon', 'price_per_night',
        'min_nights', 'max_guests', 'amenities_es', 'amenities_en',
        'house_rules_es', 'house_rules_en', 'wifi_name', 'wifi_password',
        'checkin_instructions_es', 'checkin_instructions_en',
        'checkout_instructions_es', 'checkout_instructions_en',
        'local_tips_es', 'local_tips_en', 'active',
    ];

    protected function casts(): array
    {
        return [
            'amenities_es' => 'array',
            'amenities_en' => 'array',
            'local_tips_es' => 'array',
            'local_tips_en' => 'array',
            'active' => 'boolean',
            'location_lat' => 'decimal:7',
            'location_lon' => 'decimal:7',
        ];
    }

    // Locale-aware accessors

    public function getNameAttribute(): string
    {
        return $this->{'name_' . app()->getLocale()} ?? $this->name_es;
    }

    public function getDescriptionAttribute(): string
    {
        return $this->{'description_' . app()->getLocale()} ?? $this->description_es;
    }

    public function getAmenitiesAttribute(): array
    {
        return $this->{'amenities_' . app()->getLocale()} ?? $this->amenities_es;
    }

    public function getFormattedPriceAttribute(): string
    {
        $symbol = config('solstay.business.currency_symbol', '€');
        return $symbol . number_format($this->price_per_night / 100, 0);
    }

    // Relationships

    public function photos(): HasMany
    {
        return $this->hasMany(PropertyPhoto::class)->orderBy('sort_order');
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function blockedDates(): HasMany
    {
        return $this->hasMany(BlockedDate::class);
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    // Scopes

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    // Helpers

    public function averageRating(): ?float
    {
        $avg = $this->reviews()->where('approved', true)->avg('rating');
        return $avg ? round($avg, 1) : null;
    }

    public function reviewCount(): int
    {
        return $this->reviews()->where('approved', true)->count();
    }
}
