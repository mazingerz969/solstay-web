<x-guest-public title="{{ __('Reserva confirmada') }}">
<section style="padding: 60px 24px 80px;">
    <div class="max-w-2xl mx-auto" style="text-align: center;">
        <div style="font-size: 64px; margin-bottom: 24px;">🎉</div>
        <h1 style="font-family: 'Poppins', sans-serif; font-size: 32px; font-weight: 700; color: var(--color-text); margin: 0 0 12px 0;">{{ __('¡Reserva recibida!') }}</h1>
        <p style="color: var(--color-text-secondary); font-size: 16px; margin: 0 0 40px 0;">{{ __('Tu reserva ha sido registrada. Recibirás confirmación cuando el propietario verifique el pago.') }}</p>

        <div style="background: white; border-radius: 12px; border: 1px solid var(--color-border); padding: 32px; text-align: left; box-shadow: var(--shadow-sm);">
            <div class="flex items-center justify-between" style="margin-bottom: 24px;">
                <h2 style="font-family: 'Poppins', sans-serif; color: var(--color-text); font-size: 18px; font-weight: 600; margin: 0;">{{ __('Detalles') }}</h2>
                <x-booking-status-badge :status="$booking->status" />
            </div>

            <div style="display: grid; gap: 16px;">
                <div class="flex justify-between"><span style="color: var(--color-text-secondary); font-size: 14px;">{{ __('Referencia') }}</span><span style="color: var(--color-primary); font-weight: 700;">#{{ $booking->id }}</span></div>
                <div class="flex justify-between"><span style="color: var(--color-text-secondary); font-size: 14px;">{{ __('Propiedad') }}</span><span style="color: var(--color-text); font-weight: 600;">{{ $booking->property->name }}</span></div>
                <div class="flex justify-between"><span style="color: var(--color-text-secondary); font-size: 14px;">{{ __('Fechas') }}</span><span style="color: var(--color-text);">{{ $booking->check_in->format('d/m/Y') }} → {{ $booking->check_out->format('d/m/Y') }}</span></div>
                <div class="flex justify-between"><span style="color: var(--color-text-secondary); font-size: 14px;">{{ __('Noches') }}</span><span style="color: var(--color-text);">{{ $booking->nights }}</span></div>
                <div class="flex justify-between"><span style="color: var(--color-text-secondary); font-size: 14px;">{{ __('Huéspedes') }}</span><span style="color: var(--color-text);">{{ $booking->guests }}</span></div>
                <div class="flex justify-between" style="padding-top: 16px; border-top: 1px solid var(--color-border);">
                    <span style="color: var(--color-text-secondary); font-size: 14px;">{{ __('Total') }}</span>
                    <span style="color: var(--color-primary); font-weight: 800; font-size: 20px;">{{ $booking->formatted_total }}</span>
                </div>
                <div class="flex justify-between">
                    <span style="color: var(--color-text-secondary); font-size: 14px;">{{ __('Depósito') }} ({{ config('solstay.booking.deposit_percent') }}%)</span>
                    <span style="color: #92400E; font-weight: 600;">{{ $booking->formatted_deposit }}</span>
                </div>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row justify-center gap-4" style="margin-top: 32px;">
            <a href="{{ route('booking.pdf', $booking) }}"
               style="background: white; color: var(--color-text); text-decoration: none; font-size: 15px; font-weight: 600; padding: 12px 28px; border-radius: 8px; border: 1px solid var(--color-border); display: inline-flex; align-items: center; gap: 8px; box-shadow: var(--shadow-sm); transition: all 0.2s;"
               onmouseover="this.style.borderColor='var(--color-primary)'; this.style.color='var(--color-primary)'"
               onmouseout="this.style.borderColor='var(--color-border)'; this.style.color='var(--color-text)'">
                📄 {{ __('Descargar PDF') }}
            </a>
            <a href="{{ route('dashboard') }}"
               style="background: var(--color-primary); color: white; text-decoration: none; font-size: 15px; font-weight: 600; padding: 12px 28px; border-radius: 8px; transition: all 0.2s; box-shadow: var(--shadow-sm);"
               onmouseover="this.style.background='var(--color-primary-light)'" onmouseout="this.style.background='var(--color-primary)'">
                {{ __('Ir a mi panel') }}
            </a>
        </div>
    </div>
</section>
</x-guest-public>
