<x-guest-public title="{{ __('Mi Panel') }}">
<section style="padding: 40px 24px 80px;">
    <div class="max-w-7xl mx-auto">
        <h1 style="font-family: 'Poppins', sans-serif; font-size: 28px; font-weight: 700; color: var(--color-text); margin: 0 0 8px 0;">{{ __('Hola') }}, {{ auth()->user()->name }} 👋</h1>
        <p style="color: var(--color-text-secondary); font-size: 14px; margin: 0 0 32px 0;">{{ __('Gestiona tus reservas y revisa tu historial.') }}</p>

        @if(session('success'))
            <div style="background: #D1FAE5; border: 1px solid #A7F3D0; border-radius: 8px; padding: 14px 16px; margin-bottom: 24px;">
                <p style="color: #065F46; font-size: 14px; margin: 0;">{{ session('success') }}</p>
            </div>
        @endif

        @if($upcoming->count())
            <h2 style="font-family: 'Poppins', sans-serif; color: var(--color-text); font-size: 18px; font-weight: 600; margin: 0 0 16px 0;">📅 {{ __('Próximas reservas') }}</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4" style="margin-bottom: 40px;">
                @foreach($upcoming as $booking)
                    <a href="{{ route('dashboard.bookings.show', $booking) }}" style="text-decoration: none;">
                        <div style="background: white; border-radius: 12px; border: 1px solid var(--color-border); padding: 20px; transition: all 0.3s; box-shadow: var(--shadow-sm);"
                             onmouseover="this.style.boxShadow='var(--shadow-md)'; this.style.transform='translateY(-2px)'"
                             onmouseout="this.style.boxShadow='var(--shadow-sm)'; this.style.transform='translateY(0)'">
                            <div class="flex items-center justify-between" style="margin-bottom: 10px;">
                                <span style="color: var(--color-text); font-family: 'Poppins', sans-serif; font-weight: 600;">{{ $booking->property->name }}</span>
                                <x-booking-status-badge :status="$booking->status" />
                            </div>
                            <p style="color: var(--color-text-secondary); font-size: 14px; margin: 0;">
                                📅 {{ $booking->check_in->format('d M') }} → {{ $booking->check_out->format('d M Y') }} · {{ $booking->nights }} {{ __('noches') }}
                            </p>
                            <p style="color: var(--color-accent); font-weight: 700; font-size: 16px; margin: 8px 0 0 0;">{{ $booking->formatted_total }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif

        <h2 style="font-family: 'Poppins', sans-serif; color: var(--color-text); font-size: 18px; font-weight: 600; margin: 0 0 16px 0;">📋 {{ __('Historial de reservas') }}</h2>
        @if($bookings->count())
            <div style="background: white; border-radius: 12px; border: 1px solid var(--color-border); overflow: hidden; box-shadow: var(--shadow-sm);">
                @foreach($bookings as $booking)
                    <a href="{{ route('dashboard.bookings.show', $booking) }}" style="text-decoration: none;">
                        <div class="flex items-center justify-between" style="padding: 14px 20px; {{ !$loop->last ? 'border-bottom: 1px solid var(--color-border);' : '' }} transition: background 0.2s;"
                             onmouseover="this.style.background='var(--color-bg-warm)'" onmouseout="this.style.background='white'">
                            <div>
                                <span style="color: var(--color-text); font-weight: 600; font-size: 14px;">{{ $booking->property->name }}</span>
                                <span style="color: var(--color-text-secondary); font-size: 13px; margin-left: 12px;">{{ $booking->check_in->format('d/m/Y') }}</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <x-booking-status-badge :status="$booking->status" />
                                <span style="color: var(--color-text-secondary); font-size: 14px;">{{ $booking->formatted_total }}</span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div style="background: white; border-radius: 12px; border: 1px solid var(--color-border); padding: 48px; text-align: center; box-shadow: var(--shadow-sm);">
                <p style="color: var(--color-text-secondary); font-size: 16px; margin: 0 0 16px 0;">{{ __('Aún no tienes reservas') }}</p>
                <a href="{{ route('properties.index') }}" style="color: var(--color-primary); text-decoration: none; font-weight: 600;">{{ __('Ver propiedades') }} →</a>
            </div>
        @endif
    </div>
</section>
</x-guest-public>
