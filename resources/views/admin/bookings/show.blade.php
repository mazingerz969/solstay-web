<x-guest-public title="Admin — Reserva #{{ $booking->id }}">
<section style="padding: 40px 24px 80px;">
    <div class="max-w-3xl mx-auto">
        <a href="{{ route('admin.bookings.index') }}" style="color: #a1a1aa; text-decoration: none; font-size: 14px; display: inline-flex; align-items: center; gap: 6px; margin-bottom: 24px;">← Volver a reservas</a>

        @if(session('success'))
            <div style="background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.3); border-radius: 12px; padding: 16px; margin-bottom: 24px;">
                <p style="color: #22c55e; font-size: 14px; margin: 0;">{{ session('success') }}</p>
            </div>
        @endif

        <div class="flex items-center justify-between" style="margin-bottom: 24px;">
            <h1 style="font-size: 24px; font-weight: 800; color: #fafafa; margin: 0;">Reserva #{{ $booking->id }}</h1>
            <x-booking-status-badge :status="$booking->status" />
        </div>

        <div style="background: #141418; border-radius: 16px; border: 1px solid rgba(255,255,255,0.06); padding: 28px; margin-bottom: 24px;">
            <div style="display: grid; gap: 14px;">
                <div class="flex justify-between"><span style="color: #71717a;">Propiedad</span><span style="color: #fafafa; font-weight: 600;">{{ $booking->property->name }}</span></div>
                <div class="flex justify-between"><span style="color: #71717a;">Huésped</span><span style="color: #fafafa;">{{ $booking->guest_name }}</span></div>
                <div class="flex justify-between"><span style="color: #71717a;">Teléfono</span><span style="color: #fafafa;">{{ $booking->guest_phone }}</span></div>
                <div class="flex justify-between"><span style="color: #71717a;">Email</span><span style="color: #fafafa;">{{ $booking->guest_email ?? '—' }}</span></div>
                <div class="flex justify-between"><span style="color: #71717a;">Fechas</span><span style="color: #fafafa;">{{ $booking->check_in->format('d/m/Y') }} → {{ $booking->check_out->format('d/m/Y') }}</span></div>
                <div class="flex justify-between"><span style="color: #71717a;">Noches</span><span style="color: #fafafa;">{{ $booking->nights }}</span></div>
                <div class="flex justify-between"><span style="color: #71717a;">Huéspedes</span><span style="color: #fafafa;">{{ $booking->guests }}</span></div>
                <div class="flex justify-between"><span style="color: #71717a;">Pago</span><span style="color: #fafafa;">{{ $booking->payment_method?->label() ?? '—' }}</span></div>
                <div class="flex justify-between"><span style="color: #71717a;">Pago confirmado</span><span style="color: {{ $booking->payment_confirmed ? '#22c55e' : '#f59e0b' }}; font-weight: 600;">{{ $booking->payment_confirmed ? 'Sí' : 'No' }}</span></div>
                @if($booking->notes)
                    <div class="flex justify-between"><span style="color: #71717a;">Notas</span><span style="color: #a1a1aa;">{{ $booking->notes }}</span></div>
                @endif
                <div class="flex justify-between" style="padding-top: 14px; border-top: 1px solid rgba(255,255,255,0.06);">
                    <span style="color: #71717a;">Total</span><span style="color: #14b8a6; font-weight: 800; font-size: 20px;">{{ $booking->formatted_total }}</span>
                </div>
                <div class="flex justify-between">
                    <span style="color: #71717a;">Depósito ({{ config('solstay.booking.deposit_percent') }}%)</span>
                    <span style="color: #f59e0b; font-weight: 600;">{{ $booking->formatted_deposit }}</span>
                </div>
            </div>
        </div>

        {{-- Actions --}}
        <div style="background: #141418; border-radius: 16px; border: 1px solid rgba(255,255,255,0.06); padding: 28px;">
            <h3 style="color: #fafafa; font-size: 16px; font-weight: 700; margin: 0 0 16px 0;">Acciones</h3>
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
                            <button type="submit" style="padding: 10px 20px; border-radius: 10px; border: 1px solid rgba(255,255,255,0.1); background: transparent; color: #e4e4e7; font-size: 13px; font-weight: 600; cursor: pointer;">
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
