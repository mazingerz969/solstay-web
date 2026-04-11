<x-guest-public title="{{ __('Reserva confirmada') }}">
<section style="padding: 60px 24px 80px;">
    <div class="max-w-2xl mx-auto" style="text-align: center;">
        <div style="font-size: 64px; margin-bottom: 24px;">🎉</div>
        <h1 style="font-size: 32px; font-weight: 800; color: #fafafa; margin: 0 0 12px 0;">{{ __('¡Reserva recibida!') }}</h1>
        <p style="color: #a1a1aa; font-size: 16px; margin: 0 0 40px 0;">{{ __('Tu reserva ha sido registrada. Recibirás confirmación cuando el propietario verifique el pago.') }}</p>

        <div style="background: #141418; border-radius: 16px; border: 1px solid rgba(255,255,255,0.06); padding: 32px; text-align: left;">
            <div class="flex items-center justify-between" style="margin-bottom: 24px;">
                <h2 style="color: #fafafa; font-size: 18px; font-weight: 700; margin: 0;">{{ __('Detalles') }}</h2>
                <x-booking-status-badge :status="$booking->status" />
            </div>

            <div style="display: grid; gap: 16px;">
                <div class="flex justify-between"><span style="color: #71717a;">{{ __('Referencia') }}</span><span style="color: #14b8a6; font-weight: 700;">#{{ $booking->id }}</span></div>
                <div class="flex justify-between"><span style="color: #71717a;">{{ __('Propiedad') }}</span><span style="color: #fafafa;">{{ $booking->property->name }}</span></div>
                <div class="flex justify-between"><span style="color: #71717a;">{{ __('Fechas') }}</span><span style="color: #fafafa;">{{ $booking->check_in->format('d/m/Y') }} → {{ $booking->check_out->format('d/m/Y') }}</span></div>
                <div class="flex justify-between"><span style="color: #71717a;">{{ __('Noches') }}</span><span style="color: #fafafa;">{{ $booking->nights }}</span></div>
                <div class="flex justify-between"><span style="color: #71717a;">{{ __('Huéspedes') }}</span><span style="color: #fafafa;">{{ $booking->guests }}</span></div>
                <div class="flex justify-between" style="padding-top: 16px; border-top: 1px solid rgba(255,255,255,0.06);">
                    <span style="color: #71717a;">{{ __('Total') }}</span>
                    <span style="color: #14b8a6; font-weight: 800; font-size: 20px;">{{ $booking->formatted_total }}</span>
                </div>
                <div class="flex justify-between">
                    <span style="color: #71717a;">{{ __('Depósito') }} ({{ config('solstay.booking.deposit_percent') }}%)</span>
                    <span style="color: #f59e0b; font-weight: 600;">{{ $booking->formatted_deposit }}</span>
                </div>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row justify-center gap-4" style="margin-top: 32px;">
            <a href="{{ route('booking.pdf', $booking) }}"
               style="background: #141418; color: #e4e4e7; text-decoration: none; font-size: 15px; font-weight: 600; padding: 12px 28px; border-radius: 10px; border: 1px solid rgba(255,255,255,0.06); display: inline-flex; align-items: center; gap: 8px; transition: all 0.2s;"
               onmouseover="this.style.borderColor='rgba(20,184,166,0.3)'" onmouseout="this.style.borderColor='rgba(255,255,255,0.06)'">
                📄 {{ __('Descargar PDF') }}
            </a>
            <a href="{{ route('dashboard') }}"
               style="background: #0d9488; color: white; text-decoration: none; font-size: 15px; font-weight: 600; padding: 12px 28px; border-radius: 10px; transition: all 0.2s;"
               onmouseover="this.style.background='#14b8a6'" onmouseout="this.style.background='#0d9488'">
                {{ __('Ir a mi panel') }}
            </a>
        </div>
    </div>
</section>
</x-guest-public>
