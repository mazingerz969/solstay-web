<x-guest-public title="Admin Dashboard">
<section style="padding: 40px 24px 80px;">
    <div class="max-w-7xl mx-auto">
        <h1 style="font-family: 'Poppins', sans-serif; font-size: 28px; font-weight: 700; color: var(--color-text); margin: 0 0 8px 0;">Panel de Administración</h1>
        <p style="color: var(--color-text-secondary); font-size: 14px; margin: 0 0 32px 0;">Vista general del negocio</p>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4" style="margin-bottom: 40px;">
            <x-stat-card :value="$totalBookings" label="Total Reservas" icon="📊" />
            <x-stat-card :value="$pendingBookings" label="Pendientes" icon="⏳" />
            <x-stat-card :value="$confirmedBookings" label="Confirmadas" icon="✅" />
            <x-stat-card :value="'€' . number_format($totalRevenue / 100, 0)" label="Ingresos" icon="💰" />
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4" style="margin-bottom: 40px;">
            @php
            $links = [
                ['route' => 'admin.properties.index', 'icon' => '🏡', 'label' => 'Propiedades', 'count' => $properties],
                ['route' => 'admin.bookings.index', 'icon' => '📅', 'label' => 'Reservas', 'count' => $totalBookings],
                ['route' => 'admin.blocked-dates.index', 'icon' => '🚫', 'label' => 'Fechas Bloqueadas', 'count' => ''],
                ['route' => 'admin.properties.index', 'icon' => '📸', 'label' => 'Fotos', 'count' => ''],
            ];
            @endphp
            @foreach($links as $link)
                <a href="{{ route($link['route']) }}" style="text-decoration: none;">
                    <div style="background: white; border-radius: 12px; border: 1px solid var(--color-border); padding: 20px; text-align: center; transition: all 0.3s; box-shadow: var(--shadow-sm);"
                         onmouseover="this.style.boxShadow='var(--shadow-md)'; this.style.transform='translateY(-2px)'"
                         onmouseout="this.style.boxShadow='var(--shadow-sm)'; this.style.transform='translateY(0)'">
                        <div style="font-size: 28px; margin-bottom: 8px;">{{ $link['icon'] }}</div>
                        <div style="color: var(--color-text); font-weight: 600; font-size: 14px;">{{ $link['label'] }}</div>
                        @if($link['count'] !== '')
                            <div style="color: var(--color-primary); font-size: 12px; margin-top: 4px;">{{ $link['count'] }}</div>
                        @endif
                    </div>
                </a>
            @endforeach
        </div>

        <h2 style="font-family: 'Poppins', sans-serif; color: var(--color-text); font-size: 18px; font-weight: 600; margin: 0 0 16px 0;">Últimas Reservas</h2>
        <div style="background: white; border-radius: 12px; border: 1px solid var(--color-border); overflow: hidden; box-shadow: var(--shadow-sm);">
            @forelse($recentBookings as $booking)
                <a href="{{ route('admin.bookings.show', $booking) }}" style="text-decoration: none;">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2" style="padding: 14px 20px; {{ !$loop->last ? 'border-bottom: 1px solid var(--color-border);' : '' }} transition: background 0.2s;"
                         onmouseover="this.style.background='var(--color-bg-warm)'" onmouseout="this.style.background='white'">
                        <div class="flex items-center gap-3">
                            <span style="color: var(--color-primary); font-weight: 700; font-size: 14px;">#{{ $booking->id }}</span>
                            <span style="color: var(--color-text); font-size: 14px;">{{ $booking->guest_name }}</span>
                            <span style="color: var(--color-text-light);">·</span>
                            <span style="color: var(--color-text-secondary); font-size: 13px;">{{ $booking->property->name }}</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <span style="color: var(--color-text-secondary); font-size: 13px;">{{ $booking->check_in->format('d/m') }} → {{ $booking->check_out->format('d/m') }}</span>
                            <x-booking-status-badge :status="$booking->status" />
                            <span style="color: var(--color-accent); font-weight: 600; font-size: 14px;">{{ $booking->formatted_total }}</span>
                        </div>
                    </div>
                </a>
            @empty
                <div style="padding: 48px; text-align: center; color: var(--color-text-secondary);">No hay reservas aún</div>
            @endforelse
        </div>
    </div>
</section>
</x-guest-public>
