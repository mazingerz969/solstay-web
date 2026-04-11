<x-guest-public :title="$property->name">
    <section style="padding: 32px 24px 80px;">
        <div class="max-w-7xl mx-auto">

            <a href="{{ route('properties.index') }}" style="color: var(--color-text-secondary); text-decoration: none; font-size: 14px; display: inline-flex; align-items: center; gap: 6px; margin-bottom: 20px;"
               onmouseover="this.style.color='var(--color-primary)'" onmouseout="this.style.color='var(--color-text-secondary)'">
                ← {{ __('Volver a propiedades') }}
            </a>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                {{-- Main content --}}
                <div class="lg:col-span-2">
                    {{-- Photo gallery --}}
                    <div style="border-radius: 16px; overflow: hidden; margin-bottom: 28px; background: linear-gradient(135deg, #e8f4f8, #f0f9f9); height: 400px;" x-data="{ current: 0 }">
                        @if($property->photos->count())
                            <div style="position: relative; height: 100%;">
                                @foreach($property->photos as $i => $photo)
                                    <img x-show="current === {{ $i }}" src="{{ $photo->url }}" alt="{{ $photo->caption }}"
                                         style="width: 100%; height: 100%; object-fit: cover;" x-transition>
                                @endforeach
                                @if($property->photos->count() > 1)
                                    <button @click="current = (current - 1 + {{ $property->photos->count() }}) % {{ $property->photos->count() }}"
                                            style="position: absolute; left: 12px; top: 50%; transform: translateY(-50%); background: white; border: none; color: var(--color-text); width: 40px; height: 40px; border-radius: 50%; cursor: pointer; font-size: 18px; box-shadow: var(--shadow-md);">←</button>
                                    <button @click="current = (current + 1) % {{ $property->photos->count() }}"
                                            style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: white; border: none; color: var(--color-text); width: 40px; height: 40px; border-radius: 50%; cursor: pointer; font-size: 18px; box-shadow: var(--shadow-md);">→</button>
                                @endif
                            </div>
                        @else
                            <div class="flex items-center justify-center" style="height: 100%; font-size: 80px;">🏡</div>
                        @endif
                    </div>

                    <h1 style="font-family: 'Poppins', sans-serif; font-size: 28px; font-weight: 700; color: var(--color-text); margin: 0 0 6px 0;">{{ $property->name }}</h1>
                    <p style="color: var(--color-text-secondary); font-size: 14px; margin: 0 0 20px 0;">📍 {{ $property->address }}</p>

                    <div class="flex flex-wrap items-center gap-3" style="margin-bottom: 28px;">
                        <span style="background: var(--color-bg-warm); padding: 6px 14px; border-radius: 8px; font-size: 13px; color: var(--color-text); border: 1px solid var(--color-border);">
                            🛏️ {{ __('Hasta') }} {{ $property->max_guests }} {{ __('huéspedes') }}
                        </span>
                        <span style="background: var(--color-bg-warm); padding: 6px 14px; border-radius: 8px; font-size: 13px; color: var(--color-text); border: 1px solid var(--color-border);">
                            🌙 {{ __('Mín.') }} {{ $property->min_nights }} {{ __('noches') }}
                        </span>
                        @if($rating = $property->averageRating())
                            <span style="background: #FEF3C7; padding: 6px 14px; border-radius: 8px; font-size: 13px; color: #92400E; border: 1px solid #FDE68A;">
                                ⭐ {{ $rating }} ({{ $property->reviewCount() }})
                            </span>
                        @endif
                    </div>

                    {{-- Description --}}
                    <div style="background: white; border-radius: 12px; border: 1px solid var(--color-border); padding: 24px; margin-bottom: 20px;">
                        <h3 style="font-family: 'Poppins', sans-serif; color: var(--color-text); font-size: 16px; font-weight: 600; margin: 0 0 12px 0;">{{ __('Descripción') }}</h3>
                        <p style="color: var(--color-text-secondary); font-size: 15px; line-height: 1.8; margin: 0; white-space: pre-line;">{{ $property->description }}</p>
                    </div>

                    {{-- Amenities --}}
                    <div style="background: white; border-radius: 12px; border: 1px solid var(--color-border); padding: 24px; margin-bottom: 20px;">
                        <h3 style="font-family: 'Poppins', sans-serif; color: var(--color-text); font-size: 16px; font-weight: 600; margin: 0 0 16px 0;">{{ __('Comodidades') }}</h3>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                            @foreach($property->amenities as $amenity)
                                <div style="color: var(--color-text); font-size: 14px; display: flex; align-items: center; gap: 8px;">
                                    <span style="color: var(--color-primary);">✓</span> {{ $amenity }}
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- House rules --}}
                    @php $rules = $property->{'house_rules_' . app()->getLocale()} ?: $property->house_rules_es; @endphp
                    @if($rules)
                        <div style="background: white; border-radius: 12px; border: 1px solid var(--color-border); padding: 24px; margin-bottom: 20px;">
                            <h3 style="font-family: 'Poppins', sans-serif; color: var(--color-text); font-size: 16px; font-weight: 600; margin: 0 0 12px 0;">{{ __('Normas de la casa') }}</h3>
                            <p style="color: var(--color-text-secondary); font-size: 14px; line-height: 1.8; margin: 0; white-space: pre-line;">{{ $rules }}</p>
                        </div>
                    @endif

                    {{-- Reviews --}}
                    @if($property->reviews->where('approved', true)->count())
                        <div style="background: white; border-radius: 12px; border: 1px solid var(--color-border); padding: 24px;">
                            <h3 style="font-family: 'Poppins', sans-serif; color: var(--color-text); font-size: 16px; font-weight: 600; margin: 0 0 20px 0;">
                                {{ __('Reseñas') }} ({{ $property->reviews->where('approved', true)->count() }})
                            </h3>
                            @foreach($property->reviews->where('approved', true) as $review)
                                <div style="padding: 16px 0; {{ !$loop->last ? 'border-bottom: 1px solid var(--color-border);' : '' }}">
                                    <div class="flex items-center justify-between" style="margin-bottom: 8px;">
                                        <span style="color: var(--color-text); font-weight: 600; font-size: 14px;">{{ $review->user->name }}</span>
                                        <span style="color: #F39C12; font-size: 14px;">@for($i = 0; $i < $review->rating; $i++)⭐@endfor</span>
                                    </div>
                                    <p style="color: var(--color-text-secondary); font-size: 14px; line-height: 1.6; margin: 0;">{{ $review->comment }}</p>
                                    <span style="color: var(--color-text-light); font-size: 12px; margin-top: 6px; display: block;">{{ $review->created_at->diffForHumans() }}</span>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                {{-- Sidebar --}}
                <div>
                    <div style="background: white; border-radius: 12px; border: 1px solid var(--color-border); padding: 24px; position: sticky; top: 80px; box-shadow: var(--shadow-md);">
                        <div class="flex items-baseline gap-2" style="margin-bottom: 20px;">
                            <span style="font-family: 'Poppins', sans-serif; font-size: 28px; font-weight: 700; color: var(--color-text);">{{ $property->formatted_price }}</span>
                            <span style="color: var(--color-text-secondary); font-size: 14px;">/{{ __('noche') }}</span>
                        </div>

                        {{-- Calendar --}}
                        <div x-data="calendar('{{ $property->id }}')" style="margin-bottom: 20px;">
                            <div class="flex items-center justify-between" style="margin-bottom: 12px;">
                                <button @click="prevMonth()" style="background: none; border: none; color: var(--color-text-secondary); cursor: pointer; padding: 4px 8px; font-size: 16px;">◀</button>
                                <span style="color: var(--color-text); font-weight: 600; font-size: 14px;" x-text="monthName + ' ' + year"></span>
                                <button @click="nextMonth()" style="background: none; border: none; color: var(--color-text-secondary); cursor: pointer; padding: 4px 8px; font-size: 16px;">▶</button>
                            </div>
                            <div class="grid grid-cols-7 gap-1" style="text-align: center;">
                                <template x-for="d in ['L','M','X','J','V','S','D']">
                                    <div style="color: var(--color-text-secondary); font-size: 11px; font-weight: 600; padding: 4px;" x-text="d"></div>
                                </template>
                                <template x-for="day in days">
                                    <div :style="day.style" style="font-size: 13px; padding: 6px 2px; border-radius: 6px;" x-text="day.num"></div>
                                </template>
                            </div>
                            <div class="flex items-center gap-4" style="margin-top: 10px; font-size: 11px; color: var(--color-text-secondary);">
                                <span><span style="color: #22c55e;">●</span> {{ __('Disponible') }}</span>
                                <span><span style="color: #ef4444;">●</span> {{ __('Ocupado') }}</span>
                            </div>
                        </div>

                        <a href="{{ route('booking.create', $property) }}"
                           style="display: block; text-align: center; background: var(--color-accent); color: white; text-decoration: none; font-size: 16px; font-weight: 600; padding: 14px; border-radius: 8px; transition: all 0.2s; box-shadow: 0 4px 12px rgba(232,87,75,0.25);"
                           onmouseover="this.style.background='var(--color-accent-hover)'" onmouseout="this.style.background='var(--color-accent)'">
                            {{ __('Reservar ahora') }}
                        </a>
                        <p style="text-align: center; color: var(--color-text-light); font-size: 12px; margin-top: 10px;">{{ __('Depósito del 30% para confirmar') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
    function calendar(propertyId) {
        return {
            year: new Date().getFullYear(),
            month: new Date().getMonth(),
            days: [],
            occupied: [],
            monthName: '',
            monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
            init() { this.loadMonth(); },
            async loadMonth() {
                this.monthName = this.monthNames[this.month];
                try {
                    const res = await fetch(`/api/properties/${propertyId}/calendar/${this.year}/${this.month + 1}`);
                    const data = await res.json();
                    this.occupied = data.occupied || [];
                } catch { this.occupied = []; }
                this.buildDays();
            },
            buildDays() {
                const firstDay = new Date(this.year, this.month, 1).getDay();
                const offset = firstDay === 0 ? 6 : firstDay - 1;
                const daysInMonth = new Date(this.year, this.month + 1, 0).getDate();
                const today = new Date(); today.setHours(0,0,0,0);
                this.days = [];
                for (let i = 0; i < offset; i++) this.days.push({ num: '', style: '' });
                for (let d = 1; d <= daysInMonth; d++) {
                    const dateStr = `${this.year}-${String(this.month+1).padStart(2,'0')}-${String(d).padStart(2,'0')}`;
                    const date = new Date(this.year, this.month, d);
                    const isPast = date < today;
                    const isOccupied = this.occupied.includes(dateStr);
                    let style = 'color: #22c55e;';
                    if (isPast) style = 'color: #D1D5DB;';
                    else if (isOccupied) style = 'color: #ef4444; background: #FEE2E2;';
                    this.days.push({ num: d, style });
                }
            },
            prevMonth() { this.month--; if (this.month < 0) { this.month = 11; this.year--; } this.loadMonth(); },
            nextMonth() { this.month++; if (this.month > 11) { this.month = 0; this.year++; } this.loadMonth(); }
        };
    }
    </script>
</x-guest-public>
