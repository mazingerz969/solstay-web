<x-guest-public title="Admin — Propiedades">
<section style="padding: 40px 24px 80px;">
    <div class="max-w-7xl mx-auto">
        <div class="flex items-center justify-between" style="margin-bottom: 32px;">
            <div>
                <h1 style="font-size: 28px; font-weight: 800; color: #fafafa; margin: 0 0 4px 0;">🏡 Propiedades</h1>
                <p style="color: #71717a; font-size: 14px; margin: 0;">Gestiona tus alojamientos</p>
            </div>
            <a href="{{ route('admin.properties.create') }}"
               style="background: #0d9488; color: white; text-decoration: none; font-size: 14px; font-weight: 600; padding: 10px 20px; border-radius: 10px;">
                + Nueva Propiedad
            </a>
        </div>

        @if(session('success'))
            <div style="background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.3); border-radius: 12px; padding: 16px; margin-bottom: 24px;">
                <p style="color: #22c55e; font-size: 14px; margin: 0;">{{ session('success') }}</p>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($properties as $property)
                <div style="background: #141418; border-radius: 16px; border: 1px solid rgba(255,255,255,0.06); padding: 24px;">
                    <div class="flex items-center justify-between" style="margin-bottom: 16px;">
                        <h3 style="color: #fafafa; font-size: 18px; font-weight: 700; margin: 0;">{{ $property->name_es }}</h3>
                        <span style="padding: 4px 10px; border-radius: 12px; font-size: 11px; font-weight: 600; {{ $property->active ? 'background: rgba(34,197,94,0.15); color: #22c55e;' : 'background: rgba(239,68,68,0.15); color: #ef4444;' }}">
                            {{ $property->active ? 'Activa' : 'Inactiva' }}
                        </span>
                    </div>
                    <p style="color: #71717a; font-size: 13px; margin: 0 0 12px 0;">📍 {{ $property->address }}</p>
                    <div class="flex items-center gap-4" style="color: #a1a1aa; font-size: 13px; margin-bottom: 16px;">
                        <span>💰 {{ $property->formatted_price }}/noche</span>
                        <span>📸 {{ $property->photos_count }} fotos</span>
                        <span>📅 {{ $property->bookings_count }} reservas</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('admin.properties.edit', $property) }}"
                           style="padding: 8px 16px; border-radius: 8px; background: #1a1a20; color: #e4e4e7; text-decoration: none; font-size: 13px; font-weight: 600; border: 1px solid rgba(255,255,255,0.06);">
                            ✏️ Editar
                        </a>
                        <a href="{{ route('properties.show', $property) }}"
                           style="padding: 8px 16px; border-radius: 8px; background: #1a1a20; color: #14b8a6; text-decoration: none; font-size: 13px; font-weight: 600; border: 1px solid rgba(255,255,255,0.06);">
                            👁️ Ver
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
</x-guest-public>
