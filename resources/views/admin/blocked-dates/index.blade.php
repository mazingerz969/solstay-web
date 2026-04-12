<x-guest-public title="Admin — Fechas Bloqueadas">
<section style="padding: 40px 24px 80px;">
    <div class="max-w-5xl mx-auto">
        <h1 style="font-size: 28px; font-weight: 800; color: var(--color-text); margin: 0 0 32px 0;">🚫 Fechas Bloqueadas</h1>

        @if(session('success'))
            <div style="background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.3); border-radius: 12px; padding: 16px; margin-bottom: 24px;">
                <p style="color: #22c55e; font-size: 14px; margin: 0;">{{ session('success') }}</p>
            </div>
        @endif

        {{-- Add form --}}
        <form method="POST" action="{{ route('admin.blocked-dates.store') }}"
              style="background: white; border-radius: 16px; border: 1px solid var(--color-border); padding: 24px; margin-bottom: 32px;">
            @csrf
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4 items-end">
                <div>
                    <label style="color: var(--color-text-secondary); font-size: 13px; font-weight: 600; display: block; margin-bottom: 8px;">Propiedad</label>
                    <select name="property_id" required style="width: 100%; background: var(--color-bg-warm); border: 1px solid var(--color-border); border-radius: 8px; padding: 10px; color: var(--color-text); font-size: 14px; outline: none;">
                        @foreach($properties as $p)
                            <option value="{{ $p->id }}">{{ $p->name_es }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label style="color: var(--color-text-secondary); font-size: 13px; font-weight: 600; display: block; margin-bottom: 8px;">Desde</label>
                    <input type="date" name="date_from" required style="width: 100%; background: var(--color-bg-warm); border: 1px solid var(--color-border); border-radius: 8px; padding: 10px; color: var(--color-text); font-size: 14px; outline: none;">
                </div>
                <div>
                    <label style="color: var(--color-text-secondary); font-size: 13px; font-weight: 600; display: block; margin-bottom: 8px;">Hasta</label>
                    <input type="date" name="date_to" required style="width: 100%; background: var(--color-bg-warm); border: 1px solid var(--color-border); border-radius: 8px; padding: 10px; color: var(--color-text); font-size: 14px; outline: none;">
                </div>
                <button type="submit" style="padding: 10px 20px; border-radius: 8px; border: none; background: var(--color-primary); color: white; font-size: 14px; font-weight: 600; cursor: pointer; height: 42px;">Bloquear</button>
            </div>
        </form>

        {{-- List --}}
        <div style="background: white; border-radius: 16px; border: 1px solid var(--color-border); overflow: hidden;">
            @forelse($blockedDates as $bd)
                <div class="flex items-center justify-between" style="padding: 14px 24px; {{ !$loop->last ? 'border-bottom: 1px solid var(--color-border);' : '' }}">
                    <div class="flex items-center gap-4">
                        <span style="color: var(--color-text); font-weight: 600; font-size: 14px;">{{ $bd->property->name_es }}</span>
                        <span style="color: var(--color-text-secondary); font-size: 13px;">{{ $bd->date_from->format('d/m/Y') }} → {{ $bd->date_to->format('d/m/Y') }}</span>
                        @if($bd->reason)
                            <span style="color: var(--color-text-secondary); font-size: 12px;">({{ $bd->reason }})</span>
                        @endif
                    </div>
                    <form method="POST" action="{{ route('admin.blocked-dates.destroy', $bd) }}">
                        @csrf @method('DELETE')
                        <button type="submit" style="background: rgba(239,68,68,0.1); border: none; color: #ef4444; padding: 6px 12px; border-radius: 6px; font-size: 12px; font-weight: 600; cursor: pointer;">Eliminar</button>
                    </form>
                </div>
            @empty
                <div style="padding: 48px; text-align: center; color: var(--color-text-secondary);">No hay fechas bloqueadas</div>
            @endforelse
        </div>
    </div>
</section>
</x-guest-public>
