<x-guest-public title="{{ __('Vacaciones de ensueño') }}">

    {{-- Hero Section --}}
    <section style="background: linear-gradient(135deg, #f0f9f9 0%, #e8f4f8 50%, #fef3f0 100%); padding: 80px 24px 60px; position: relative; overflow: hidden;">
        <div style="position: absolute; top: -60px; right: -60px; width: 300px; height: 300px; background: radial-gradient(circle, rgba(27,139,140,0.08) 0%, transparent 70%); pointer-events: none;"></div>

        <div class="max-w-7xl mx-auto" style="text-align: center;">
            <span style="display: inline-block; padding: 6px 16px; border-radius: 20px; background: rgba(27,139,140,0.1); color: var(--color-primary); font-size: 13px; font-weight: 600; margin-bottom: 20px;">
                ☀️ {{ __('Reserva directo, sin comisiones') }}
            </span>

            <h1 style="font-family: 'Poppins', sans-serif; font-size: clamp(32px, 5vw, 52px); font-weight: 800; color: var(--color-text); line-height: 1.15; margin: 0 0 20px 0; letter-spacing: -0.02em;">
                {{ __('Tu próxima escapada') }}<br>
                <span style="color: var(--color-primary);">{{ __('empieza aquí') }}</span>
            </h1>

            <p style="font-size: 18px; color: var(--color-text-secondary); line-height: 1.7; margin: 0 auto 36px; max-width: 600px;">
                {{ __('Alojamientos vacacionales en la costa y la sierra. Trato directo con el propietario y los mejores precios.') }}
            </p>

            {{-- Search bar --}}
            <div class="max-w-2xl mx-auto" style="background: white; border-radius: 12px; padding: 16px; box-shadow: var(--shadow-lg); display: flex; flex-wrap: wrap; gap: 12px; align-items: end;">
                <div class="flex-1" style="min-width: 140px;">
                    <label style="display: block; font-size: 11px; font-weight: 600; color: var(--color-text); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px;">{{ __('Destino') }}</label>
                    <select style="width: 100%; padding: 10px 12px; border: 1px solid var(--color-border); border-radius: 8px; font-size: 14px; color: var(--color-text); outline: none; background: white;">
                        <option>{{ __('Todos los destinos') }}</option>
                        @foreach($properties as $p)
                            <option value="{{ $p->id }}">{{ $p->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div style="min-width: 130px;">
                    <label style="display: block; font-size: 11px; font-weight: 600; color: var(--color-text); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px;">{{ __('Entrada') }}</label>
                    <input type="date" style="width: 100%; padding: 10px 12px; border: 1px solid var(--color-border); border-radius: 8px; font-size: 14px; color: var(--color-text); outline: none;">
                </div>
                <div style="min-width: 130px;">
                    <label style="display: block; font-size: 11px; font-weight: 600; color: var(--color-text); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 6px;">{{ __('Salida') }}</label>
                    <input type="date" style="width: 100%; padding: 10px 12px; border: 1px solid var(--color-border); border-radius: 8px; font-size: 14px; color: var(--color-text); outline: none;">
                </div>
                <a href="{{ route('properties.index') }}" style="background: var(--color-accent); color: white; text-decoration: none; font-size: 14px; font-weight: 600; padding: 11px 28px; border-radius: 8px; white-space: nowrap; transition: background 0.2s;"
                   onmouseover="this.style.background='var(--color-accent-hover)'" onmouseout="this.style.background='var(--color-accent)'">
                    {{ __('Buscar') }}
                </a>
            </div>
        </div>
    </section>

    {{-- Properties --}}
    <section style="padding: 60px 24px;">
        <div class="max-w-7xl mx-auto">
            <div style="margin-bottom: 36px;">
                <h2 style="font-family: 'Poppins', sans-serif; font-size: 28px; font-weight: 700; color: var(--color-text); margin: 0 0 8px 0;">{{ __('Nuestros alojamientos') }}</h2>
                <p style="color: var(--color-text-secondary); font-size: 16px; margin: 0;">{{ __('Encuentra tu lugar ideal para descansar') }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @foreach($properties as $property)
                    <x-property-card :property="$property" />
                @endforeach
            </div>
        </div>
    </section>

    {{-- Features --}}
    <section style="padding: 60px 24px; background: var(--color-bg-warm);">
        <div class="max-w-7xl mx-auto">
            <div style="text-align: center; margin-bottom: 48px;">
                <h2 style="font-family: 'Poppins', sans-serif; font-size: 28px; font-weight: 700; color: var(--color-text); margin: 0 0 8px 0;">{{ __('¿Por qué reservar con SolStay?') }}</h2>
                <p style="color: var(--color-text-secondary); font-size: 16px; margin: 0;">{{ __('Ventajas de reservar directo') }}</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @php
                $features = [
                    ['icon' => '💰', 'title' => __('Sin comisiones'), 'desc' => __('Reserva directo sin intermediarios. El precio que ves es el que pagas.')],
                    ['icon' => '🔒', 'title' => __('Reserva segura'), 'desc' => __('Pago por transferencia o Bizum. Confirmación inmediata y depósito del 30%.')],
                    ['icon' => '🤝', 'title' => __('Trato personal'), 'desc' => __('Comunicación directa con el propietario. Consejos locales y atención personalizada.')],
                ];
                @endphp

                @foreach($features as $f)
                    <div style="background: white; border-radius: 12px; padding: 32px; box-shadow: var(--shadow-sm); text-align: center;">
                        <div style="font-size: 40px; margin-bottom: 16px;">{{ $f['icon'] }}</div>
                        <h3 style="font-family: 'Poppins', sans-serif; font-size: 18px; font-weight: 600; color: var(--color-text); margin: 0 0 12px 0;">{{ $f['title'] }}</h3>
                        <p style="font-size: 14px; color: var(--color-text-secondary); line-height: 1.7; margin: 0;">{{ $f['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CTA --}}
    <section style="padding: 80px 24px;">
        <div class="max-w-2xl mx-auto" style="text-align: center;">
            <h2 style="font-family: 'Poppins', sans-serif; font-size: 28px; font-weight: 700; color: var(--color-text); margin: 0 0 12px 0;">{{ __('¿Listo para reservar?') }}</h2>
            <p style="font-size: 16px; color: var(--color-text-secondary); margin: 0 0 28px 0;">{{ __('Crea tu cuenta gratis y reserva en menos de 5 minutos.') }}</p>
            <a href="{{ route('register') }}"
               style="background: var(--color-accent); color: white; text-decoration: none; font-size: 16px; font-weight: 600; padding: 14px 36px; border-radius: 8px; display: inline-block; transition: all 0.2s; box-shadow: 0 4px 12px rgba(232,87,75,0.25);"
               onmouseover="this.style.background='var(--color-accent-hover)'; this.style.transform='translateY(-2px)'"
               onmouseout="this.style.background='var(--color-accent)'; this.style.transform='translateY(0)'">
                {{ __('Crear cuenta gratis') }}
            </a>
        </div>
    </section>

</x-guest-public>
