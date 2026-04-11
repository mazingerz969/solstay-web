<x-guest-public title="{{ __('Reserva') }} #{{ $booking->id }}">
<section style="padding: 40px 24px 80px;">
    <div class="max-w-3xl mx-auto">
        <a href="{{ route('dashboard') }}" style="color: #a1a1aa; text-decoration: none; font-size: 14px; margin-bottom: 24px; display: inline-block;">← {{ __('Volver a mi panel') }}</a>

        @if(session('success'))
            <div style="background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.3); border-radius: 12px; padding: 16px; margin-bottom: 24px;">
                <p style="color: #22c55e; font-size: 14px; margin: 0;">{{ session('success') }}</p>
            </div>
        @endif

        <div class="flex items-center justify-between" style="margin-bottom: 24px;">
            <h1 style="font-size: 24px; font-weight: 800; color: #fafafa; margin: 0;">{{ __('Reserva') }} #{{ $booking->id }}</h1>
            <x-booking-status-badge :status="$booking->status" />
        </div>

        <div style="background: #141418; border-radius: 16px; border: 1px solid rgba(255,255,255,0.06); padding: 28px; margin-bottom: 24px;">
            <div style="display: grid; gap: 14px;">
                <div class="flex justify-between"><span style="color: #71717a;">{{ __('Propiedad') }}</span><span style="color: #fafafa; font-weight: 600;">{{ $booking->property->name }}</span></div>
                <div class="flex justify-between"><span style="color: #71717a;">{{ __('Fechas') }}</span><span style="color: #fafafa;">{{ $booking->check_in->format('d/m/Y') }} → {{ $booking->check_out->format('d/m/Y') }}</span></div>
                <div class="flex justify-between"><span style="color: #71717a;">{{ __('Noches') }}</span><span style="color: #fafafa;">{{ $booking->nights }}</span></div>
                <div class="flex justify-between"><span style="color: #71717a;">{{ __('Huéspedes') }}</span><span style="color: #fafafa;">{{ $booking->guests }}</span></div>
                <div class="flex justify-between" style="padding-top: 14px; border-top: 1px solid rgba(255,255,255,0.06);">
                    <span style="color: #71717a;">{{ __('Total') }}</span><span style="color: #14b8a6; font-weight: 800; font-size: 20px;">{{ $booking->formatted_total }}</span>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap gap-3">
            <a href="{{ route('booking.pdf', $booking) }}" style="padding: 10px 20px; border-radius: 10px; background: #141418; color: #e4e4e7; text-decoration: none; font-size: 14px; font-weight: 600; border: 1px solid rgba(255,255,255,0.06);">📄 {{ __('Descargar PDF') }}</a>

            @if($booking->canBeCancelled())
                <form method="POST" action="{{ route('dashboard.bookings.cancel', $booking) }}" onsubmit="return confirm('{{ __('¿Seguro que quieres cancelar?') }}')">
                    @csrf
                    <button type="submit" style="padding: 10px 20px; border-radius: 10px; background: rgba(239,68,68,0.1); color: #ef4444; border: 1px solid rgba(239,68,68,0.2); font-size: 14px; font-weight: 600; cursor: pointer;">❌ {{ __('Cancelar reserva') }}</button>
                </form>
            @endif
        </div>
    </div>
</section>
</x-guest-public>
