<x-guest-public title="{{ __('Propiedades') }}">
    <section style="padding: 40px 24px 80px;">
        <div class="max-w-7xl mx-auto">
            <div style="margin-bottom: 48px;">
                <span style="color: #14b8a6; font-size: 13px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.1em;">{{ __('Alojamientos') }}</span>
                <h1 style="font-size: 36px; font-weight: 800; color: #fafafa; margin: 12px 0 8px 0;">{{ __('Nuestras propiedades') }}</h1>
                <p style="color: #a1a1aa; font-size: 16px;">{{ __('Elige tu destino y empieza a planificar tus vacaciones.') }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($properties as $property)
                    <x-property-card :property="$property" />
                @endforeach
            </div>
        </div>
    </section>
</x-guest-public>
