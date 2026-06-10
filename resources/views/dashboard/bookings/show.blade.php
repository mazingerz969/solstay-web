<x-guest-public title="{{ __('Reserva') }} #{{ $booking->id }}">
<section style="padding: 40px 24px 80px;">
    <div class="max-w-3xl mx-auto">
        <a href="{{ route('dashboard') }}" style="color: var(--color-text-secondary); text-decoration: none; font-size: 14px; margin-bottom: 24px; display: inline-block; transition: color 0.2s;"
           onmouseover="this.style.color='var(--color-primary)'" onmouseout="this.style.color='var(--color-text-secondary)'">← {{ __('Volver a mi panel') }}</a>

        @if(session('success'))
            <div style="background: #D1FAE5; border: 1px solid #A7F3D0; border-radius: 12px; padding: 16px; margin-bottom: 24px;">
                <p style="color: #065F46; font-size: 14px; margin: 0;">{{ session('success') }}</p>
            </div>
        @endif

        <div class="flex items-center justify-between" style="margin-bottom: 24px;">
            <h1 style="font-family: 'Poppins', sans-serif; font-size: 24px; font-weight: 700; color: var(--color-text); margin: 0;">{{ __('Reserva') }} #{{ $booking->id }}</h1>
            <x-booking-status-badge :status="$booking->status" />
        </div>

        <div style="background: white; border-radius: 12px; border: 1px solid var(--color-border); padding: 28px; margin-bottom: 24px; box-shadow: var(--shadow-sm);">
            <div style="display: grid; gap: 14px;">
                <div class="flex justify-between"><span style="color: var(--color-text-secondary); font-size: 14px;">{{ __('Propiedad') }}</span><span style="color: var(--color-text); font-weight: 600;">{{ $booking->property->name }}</span></div>
                <div class="flex justify-between"><span style="color: var(--color-text-secondary); font-size: 14px;">{{ __('Fechas') }}</span><span style="color: var(--color-text);">{{ $booking->check_in->format('d/m/Y') }} → {{ $booking->check_out->format('d/m/Y') }}</span></div>
                <div class="flex justify-between"><span style="color: var(--color-text-secondary); font-size: 14px;">{{ __('Noches') }}</span><span style="color: var(--color-text);">{{ $booking->nights }}</span></div>
                <div class="flex justify-between"><span style="color: var(--color-text-secondary); font-size: 14px;">{{ __('Huéspedes') }}</span><span style="color: var(--color-text);">{{ $booking->guests }}</span></div>
                <div class="flex justify-between" style="padding-top: 14px; border-top: 1px solid var(--color-border);">
                    <span style="color: var(--color-text-secondary); font-size: 14px;">{{ __('Total') }}</span>
                    <span style="color: var(--color-primary); font-weight: 800; font-size: 20px;">{{ $booking->formatted_total }}</span>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap gap-3">
            <a href="{{ route('booking.pdf', $booking) }}"
               style="padding: 10px 20px; border-radius: 8px; background: white; color: var(--color-text); text-decoration: none; font-size: 14px; font-weight: 600; border: 1px solid var(--color-border); box-shadow: var(--shadow-sm); transition: all 0.2s;"
               onmouseover="this.style.borderColor='var(--color-primary)'; this.style.color='var(--color-primary)'"
               onmouseout="this.style.borderColor='var(--color-border)'; this.style.color='var(--color-text)'">📄 {{ __('Descargar PDF') }}</a>

            @if($booking->canBeCancelled())
                <form method="POST" action="{{ route('dashboard.bookings.cancel', $booking) }}" onsubmit="return confirm('{{ __('¿Seguro que quieres cancelar?') }}')">
                    @csrf
                    <button type="submit" style="padding: 10px 20px; border-radius: 8px; background: #FEE2E2; color: #991B1B; border: 1px solid #FECACA; font-size: 14px; font-weight: 600; cursor: pointer; transition: all 0.2s;"
                            onmouseover="this.style.background='#FECACA'" onmouseout="this.style.background='#FEE2E2'">❌ {{ __('Cancelar reserva') }}</button>
                </form>
            @endif
        </div>
    </div>
</section>
</x-guest-public>
