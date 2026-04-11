<?php

namespace App\Enums;

enum BookingStatus: string
{
    case Pending = 'pending';
    case Confirmed = 'confirmed';
    case CheckedIn = 'checked_in';
    case Completed = 'completed';
    case Cancelled = 'cancelled';

    public function label(string $locale = 'es'): string
    {
        return match ($this) {
            self::Pending => $locale === 'es' ? 'Pendiente' : 'Pending',
            self::Confirmed => $locale === 'es' ? 'Confirmada' : 'Confirmed',
            self::CheckedIn => $locale === 'es' ? 'Check-in' : 'Checked In',
            self::Completed => $locale === 'es' ? 'Completada' : 'Completed',
            self::Cancelled => $locale === 'es' ? 'Cancelada' : 'Cancelled',
        };
    }

    public function color(): string
    {
        return match ($this) {
            self::Pending => '#f59e0b',
            self::Confirmed => '#14b8a6',
            self::CheckedIn => '#3b82f6',
            self::Completed => '#22c55e',
            self::Cancelled => '#ef4444',
        };
    }

    public function icon(): string
    {
        return match ($this) {
            self::Pending => '⏳',
            self::Confirmed => '✅',
            self::CheckedIn => '🏠',
            self::Completed => '🎉',
            self::Cancelled => '❌',
        };
    }
}
