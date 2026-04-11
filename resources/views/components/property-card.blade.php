@props(['property'])

<a href="{{ route('properties.show', $property) }}" style="text-decoration: none; display: block;">
    <div style="background: white; border-radius: 12px; overflow: hidden; box-shadow: var(--shadow-md); transition: all 0.3s;"
         onmouseover="this.style.boxShadow='var(--shadow-lg)'; this.style.transform='translateY(-4px)'"
         onmouseout="this.style.boxShadow='var(--shadow-md)'; this.style.transform='translateY(0)'">

        {{-- Photo --}}
        <div style="height: 220px; background: linear-gradient(135deg, #e8f4f8, #f0f9f9); position: relative; overflow: hidden;">
            @if($property->photos->count())
                <img src="{{ $property->photos->first()->url }}" alt="{{ $property->name }}"
                     style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s;"
                     onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
            @else
                <div class="flex items-center justify-center" style="height: 100%; font-size: 56px;">
                    🏡
                </div>
            @endif
            <div style="position: absolute; top: 12px; right: 12px; background: white; padding: 4px 12px; border-radius: 20px; box-shadow: var(--shadow-sm);">
                <span style="color: var(--color-accent); font-weight: 700; font-size: 15px;">{{ $property->formatted_price }}</span>
                <span style="color: var(--color-text-light); font-size: 12px;">/{{ __('noche') }}</span>
            </div>
        </div>

        {{-- Info --}}
        <div style="padding: 16px 20px 20px;">
            <h3 style="font-family: 'Poppins', sans-serif; color: var(--color-text); font-size: 17px; font-weight: 600; margin: 0 0 4px 0;">{{ $property->name }}</h3>
            <p style="color: var(--color-text-secondary); font-size: 13px; margin: 0 0 12px 0;">📍 {{ $property->address }}</p>

            <div class="flex items-center gap-4" style="color: var(--color-text-secondary); font-size: 13px;">
                <span>🛏️ {{ $property->max_guests }} {{ __('huéspedes') }}</span>
                <span>🌙 {{ __('Mín.') }} {{ $property->min_nights }} {{ __('noches') }}</span>
            </div>

            @if($rating = $property->averageRating())
                <div class="flex items-center gap-2" style="margin-top: 10px;">
                    <span style="color: #F39C12; font-size: 14px;">⭐ {{ $rating }}</span>
                    <span style="color: var(--color-text-light); font-size: 12px;">({{ $property->reviewCount() }} {{ __('reseñas') }})</span>
                </div>
            @endif
        </div>
    </div>
</a>
