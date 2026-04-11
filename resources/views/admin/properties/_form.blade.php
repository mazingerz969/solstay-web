@php $p = $property ?? null; @endphp

<div class="grid grid-cols-1 gap-4">
    @if(!$p)
    <div>
        <label style="color: #a1a1aa; font-size: 13px; font-weight: 600; display: block; margin-bottom: 8px;">ID (slug)</label>
        <input type="text" name="id" value="{{ old('id') }}" required placeholder="costa-del-sol"
               style="width: 100%; background: #1a1a20; border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; padding: 12px 16px; color: #fafafa; font-size: 15px; outline: none;">
    </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label style="color: #a1a1aa; font-size: 13px; font-weight: 600; display: block; margin-bottom: 8px;">Nombre (ES)</label>
            <input type="text" name="name_es" value="{{ old('name_es', $p?->name_es) }}" required
                   style="width: 100%; background: #1a1a20; border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; padding: 12px 16px; color: #fafafa; font-size: 15px; outline: none;">
        </div>
        <div>
            <label style="color: #a1a1aa; font-size: 13px; font-weight: 600; display: block; margin-bottom: 8px;">Nombre (EN)</label>
            <input type="text" name="name_en" value="{{ old('name_en', $p?->name_en) }}" required
                   style="width: 100%; background: #1a1a20; border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; padding: 12px 16px; color: #fafafa; font-size: 15px; outline: none;">
        </div>
    </div>

    <div>
        <label style="color: #a1a1aa; font-size: 13px; font-weight: 600; display: block; margin-bottom: 8px;">Descripción (ES)</label>
        <textarea name="description_es" rows="3" required style="width: 100%; background: #1a1a20; border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; padding: 12px 16px; color: #fafafa; font-size: 15px; outline: none; resize: vertical;">{{ old('description_es', $p?->description_es) }}</textarea>
    </div>
    <div>
        <label style="color: #a1a1aa; font-size: 13px; font-weight: 600; display: block; margin-bottom: 8px;">Descripción (EN)</label>
        <textarea name="description_en" rows="3" required style="width: 100%; background: #1a1a20; border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; padding: 12px 16px; color: #fafafa; font-size: 15px; outline: none; resize: vertical;">{{ old('description_en', $p?->description_en) }}</textarea>
    </div>

    <div>
        <label style="color: #a1a1aa; font-size: 13px; font-weight: 600; display: block; margin-bottom: 8px;">Dirección</label>
        <input type="text" name="address" value="{{ old('address', $p?->address) }}" required
               style="width: 100%; background: #1a1a20; border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; padding: 12px 16px; color: #fafafa; font-size: 15px; outline: none;">
    </div>

    <div class="grid grid-cols-3 gap-4">
        <div>
            <label style="color: #a1a1aa; font-size: 13px; font-weight: 600; display: block; margin-bottom: 8px;">Precio/noche (céntimos)</label>
            <input type="number" name="price_per_night" value="{{ old('price_per_night', $p?->price_per_night) }}" required min="100"
                   style="width: 100%; background: #1a1a20; border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; padding: 12px 16px; color: #fafafa; font-size: 15px; outline: none;">
        </div>
        <div>
            <label style="color: #a1a1aa; font-size: 13px; font-weight: 600; display: block; margin-bottom: 8px;">Mín. noches</label>
            <input type="number" name="min_nights" value="{{ old('min_nights', $p?->min_nights ?? 2) }}" required min="1"
                   style="width: 100%; background: #1a1a20; border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; padding: 12px 16px; color: #fafafa; font-size: 15px; outline: none;">
        </div>
        <div>
            <label style="color: #a1a1aa; font-size: 13px; font-weight: 600; display: block; margin-bottom: 8px;">Máx. huéspedes</label>
            <input type="number" name="max_guests" value="{{ old('max_guests', $p?->max_guests ?? 4) }}" required min="1"
                   style="width: 100%; background: #1a1a20; border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; padding: 12px 16px; color: #fafafa; font-size: 15px; outline: none;">
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label style="color: #a1a1aa; font-size: 13px; font-weight: 600; display: block; margin-bottom: 8px;">Amenities ES (separadas por coma)</label>
            <input type="text" name="amenities_es" value="{{ old('amenities_es', $p ? implode(', ', $p->amenities_es) : '') }}"
                   style="width: 100%; background: #1a1a20; border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; padding: 12px 16px; color: #fafafa; font-size: 15px; outline: none;">
        </div>
        <div>
            <label style="color: #a1a1aa; font-size: 13px; font-weight: 600; display: block; margin-bottom: 8px;">Amenities EN (separadas por coma)</label>
            <input type="text" name="amenities_en" value="{{ old('amenities_en', $p ? implode(', ', $p->amenities_en) : '') }}"
                   style="width: 100%; background: #1a1a20; border: 1px solid rgba(255,255,255,0.1); border-radius: 10px; padding: 12px 16px; color: #fafafa; font-size: 15px; outline: none;">
        </div>
    </div>

    @if($p)
    <div class="flex items-center gap-3" style="margin-top: 8px;">
        <label style="color: #a1a1aa; font-size: 13px; font-weight: 600;">Activa</label>
        <input type="hidden" name="active" value="0">
        <input type="checkbox" name="active" value="1" {{ $p->active ? 'checked' : '' }}
               style="width: 20px; height: 20px; accent-color: #14b8a6;">
    </div>
    @endif
</div>

@if($errors->any())
    <div style="background: rgba(239,68,68,0.1); border: 1px solid rgba(239,68,68,0.3); border-radius: 12px; padding: 16px; margin-top: 16px;">
        @foreach($errors->all() as $error)
            <p style="color: #ef4444; font-size: 14px; margin: 0;">{{ $error }}</p>
        @endforeach
    </div>
@endif
