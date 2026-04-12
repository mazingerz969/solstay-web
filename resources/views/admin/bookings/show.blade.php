<x-guest-public title="Admin — Reserva #{{ $booking->id }}">
<section style="padding: 40px 24px 80px;">
    <div class="max-w-3xl mx-auto">
        <a href="{{ route('admin.bookings.index') }}" style="color: var(--color-text-secondary); text-decoration: none; font-size: 14px; display: inline-flex; align-items: center; gap: 6px; margin-bottom: 24px;">← Volver a reservas</a>

        @if(session('success'))
            <div style="background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.3); border-radius: 12px; padding: 16px; margin-bottom: 24px;">
                <p style="color: #22c55e; font-size: 14px; margin: 0;">{{ session('success') }}</p>
            </div>
        @endif

        <div class="flex items-center justify-between" style="margin-bottom: 24px;">
            <h1 style="font-size: 24px; font-weight: 800; color: var(--color-text); margin: 0;">Reserva #{{ $booking->id }}</h1>
            <x-booking-status-badge :status="$booking->status" />
        </div>

        <div style="background: white; border-radius: 16px; border: 1px solid var(--color-border); padding: 28px; margin-bottom: 24px;">
            <div style="display: grid; gap: 14px;">
                <div class="flex justify-between"><span style="color: var(--color-text-secondary);">Propiedad</span><span style="color: var(--color-text); font-weight: 600;">{{ $booking->property->name }}</span></div>
                <div class="flex justify-between"><span style="color: var(--color-text-secondary);">Huésped</span><span style="color: var(--color-text);">{{ $booking->guest_name }}</span></div>
                <div class="flex justify-between"><span style="color: var(--color-text-secondary);">Teléfono</span><span style="color: var(--color-text);">{{ $booking->guest_phone }}</span></div>
                <div class="flex justify-between"><span style="color: var(--color-text-secondary);">Email</span><span style="color: var(--color-text);">{{ $booking->guest_email ?? '—' }}</span></div>
                <div class="flex justify-between"><span style="color: var(--color-text-secondary);">Fechas</span><span style="color: var(--color-text);">{{ $booking->check_in->format('d/m/Y') }} → {{ $booking->check_out->format('d/m/Y') }}</span></div>
                <div class="flex justify-between"><span style="color: var(--color-text-secondary);">Noches</span><span style="color: var(--color-text);">{{ $booking->nights }}</span></div>
                <div class="flex justify-between"><span style="color: var(--color-text-secondary);">Huéspedes</span><span style="color: var(--color-text);">{{ $booking->guests }}</span></div>
                <div class="flex justify-between"><span style="color: var(--color-text-secondary);">Pago</span><span style="color: var(--color-text);">{{ $booking->payment_method?->label() ?? '—' }}</span></div>
                <div class="flex justify-between"><span style="color: var(--color-text-secondary);">Pago confirmado</span><span style="color: {{ $booking->payment_confirmed ? '#22c55e' : '#f59e0b' }}; font-weight: 600;">{{ $booking->payment_confirmed ? 'Sí' : 'No' }}</span></div>
                @if($booking->notes)
                    <div class="flex justify-between"><span style="color: var(--color-text-secondary);">Notas</span><span style="color: var(--color-text-secondary);">{{ $booking->notes }}</span></div>
                @endif
                <div class="flex justify-between" style="padding-top: 14px; border-top: 1px solid var(--color-border);">
                    <span style="color: var(--color-text-secondary);">Total</span><span style="color: var(--color-primary); font-weight: 800; font-size: 20px;">{{ $booking->formatted_total }}</span>
                </div>
                <div class="flex justify-between">
                    <span style="color: var(--color-text-secondary);">Depósito ({{ config('solstay.booking.deposit_percent') }}%)</span>
                    <span style="color: #f59e0b; font-weight: 600;">{{ $booking->formatted_deposit }}</span>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div style="background: white; border-radius: 16px; border: 1px solid var(--color-border); padding: 28px;">
            <h3 style="color: var(--color-text); font-size: 16px; font-weight: 700; margin: 0 0 16px 0;">Acciones</h3>
            <div class="flex flex-wrap gap-3">
                @if(!$booking->payment_confirmed)
                    <form method="POST" action="{{ route('admin.bookings.confirm-payment', $booking) }}">
                        @csrf
                        <button type="submit" style="padding: 10px 20px; border-radius: 10px; border: none; background: #22c55e; color: white; font-size: 14px; font-weight: 600; cursor: pointer;">💳 Confirmar Pago</button>
                    </form>
                @endif

                @foreach(\App\Enums\BookingStatus::cases() as $status)
                    @if($status !== $booking->status)
                        <form method="POST" action="{{ route('admin.bookings.status', $booking) }}">
                            @csrf
                            <input type="hidden" name="status" value="{{ $status->value }}">
                            <button type="submit" style="padding: 10px 20px; border-radius: 10px; border: 1px solid var(--color-border); background: transparent; color: var(--color-text); font-size: 13px; font-weight: 600; cursor: pointer;">
                                {{ $status->icon() }} → {{ $status->label() }}
                            </button>
                        </form>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</section>
</x-guest-public>
