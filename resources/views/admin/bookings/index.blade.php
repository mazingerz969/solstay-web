<x-guest-public title="Admin — Reservas">
<section style="padding: 40px 24px 80px;">
    <div class="max-w-7xl mx-auto">
        <h1 style="font-size: 28px; font-weight: 800; color: var(--color-text); margin: 0 0 4px 0;">📅 Reservas</h1>
        <p style="color: var(--color-text-secondary); font-size: 14px; margin: 0 0 32px 0;">Gestiona todas las reservas</p>

        @if(session('success'))
            <div style="background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.3); border-radius: 12px; padding: 16px; margin-bottom: 24px;">
                <p style="color: #22c55e; font-size: 14px; margin: 0;">{{ session('success') }}</p>
            </div>
        @endif

        <div style="background: white; border-radius: 16px; border: 1px solid var(--color-border); overflow: hidden;">
            @forelse($bookings as $booking)
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3" style="padding: 16px 24px; {{ !$loop->last ? 'border-bottom: 1px solid var(--color-border);' : '' }}">
                    <div class="flex items-center gap-3">
                        <span style="color: var(--color-primary); font-weight: 700; font-size: 14px;">#{{ $booking->id }}</span>
                        <span style="color: var(--color-text); font-weight: 600; font-size: 14px;">{{ $booking->guest_name }}</span>
                        <span style="color: var(--color-text-secondary); font-size: 13px;">{{ $booking->property->name }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span style="color: var(--color-text-secondary); font-size: 13px;">{{ $booking->check_in->format('d/m') }} → {{ $booking->check_out->format('d/m') }}</span>
                        <x-booking-status-badge :status="$booking->status" />
                        <span style="color: var(--color-text); font-weight: 600;">{{ $booking->formatted_total }}</span>
                        <a href="{{ route('admin.bookings.show', $booking) }}" style="color: var(--color-primary); text-decoration: none; font-size: 13px; font-weight: 600;">Ver →</a>
                    </div>
                </div>
            @empty
                <div style="padding: 48px; text-align: center; color: var(--color-text-secondary);">No hay reservas</div>
            @endforelse
        </div>

        <div style="margin-top: 24px;">{{ $bookings->links() }}</div>
    </div>
</section>
</x-guest-public>
