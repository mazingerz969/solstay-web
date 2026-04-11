<x-guest-public title="{{ __('Reservar') }} — {{ $property->name }}">
<section style="padding: 40px 24px 80px;">
    <div class="max-w-3xl mx-auto">
        <a href="{{ route('properties.show', $property) }}" style="color: var(--color-text-secondary); text-decoration: none; font-size: 14px; display: inline-flex; align-items: center; gap: 6px; margin-bottom: 24px;">
            ← {{ __('Volver a') }} {{ $property->name }}
        </a>

        <h1 style="font-family: 'Poppins', sans-serif; font-size: 24px; font-weight: 700; color: var(--color-text); margin: 0 0 6px 0;">{{ __('Reservar') }} {{ $property->name }}</h1>
        <p style="color: var(--color-text-secondary); font-size: 14px; margin: 0 0 32px 0;">{{ $property->formatted_price }}/{{ __('noche') }} · {{ __('Mín.') }} {{ $property->min_nights }} {{ __('noches') }} · {{ __('Máx.') }} {{ $property->max_guests }} {{ __('huéspedes') }}</p>

        @if($errors->any())
            <div style="background: #FEE2E2; border: 1px solid #FECACA; border-radius: 8px; padding: 14px; margin-bottom: 24px;">
                @foreach($errors->all() as $error)
                    <p style="color: #991B1B; font-size: 14px; margin: 0;">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('booking.store', $property) }}" x-data="bookingForm()" @submit.prevent="submitForm($el)">
            @csrf

            {{-- Steps --}}
            <div class="flex items-center justify-center gap-2" style="margin-bottom: 36px;">
                <template x-for="(label, i) in steps">
                    <div class="flex items-center gap-2">
                        <div :style="i <= step ? 'background: var(--color-primary); color: white;' : 'background: var(--color-bg-warm); color: var(--color-text-light); border: 1px solid var(--color-border);'"
                             style="width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 600; transition: all 0.3s;"
                             x-text="i + 1"></div>
                        <span x-show="i < steps.length - 1" style="width: 40px; height: 2px;" :style="i < step ? 'background: var(--color-primary);' : 'background: var(--color-border);'"></span>
                    </div>
                </template>
            </div>

            {{-- Step 1: Dates --}}
            <div x-show="step === 0" x-transition style="background: white; border-radius: 12px; border: 1px solid var(--color-border); padding: 28px; box-shadow: var(--shadow-sm);">
                <h2 style="font-family: 'Poppins', sans-serif; color: var(--color-text); font-size: 18px; font-weight: 600; margin: 0 0 20px 0;">📅 {{ __('Selecciona fechas') }}</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label style="color: var(--color-text-secondary); font-size: 13px; font-weight: 600; display: block; margin-bottom: 6px;">{{ __('Check-in') }}</label>
                        <input type="date" name="check_in" x-model="checkIn" required
                               min="{{ now()->addDays(config('solstay.booking.min_advance_days'))->format('Y-m-d') }}"
                               style="width: 100%; background: white; border: 1px solid var(--color-border); border-radius: 8px; padding: 10px 14px; color: var(--color-text); font-size: 14px; outline: none;"
                               onfocus="this.style.borderColor='var(--color-primary)'" onblur="this.style.borderColor='var(--color-border)'">
                    </div>
                    <div>
                        <label style="color: var(--color-text-secondary); font-size: 13px; font-weight: 600; display: block; margin-bottom: 6px;">{{ __('Check-out') }}</label>
                        <input type="date" name="check_out" x-model="checkOut" required :min="minCheckOut"
                               style="width: 100%; background: white; border: 1px solid var(--color-border); border-radius: 8px; padding: 10px 14px; color: var(--color-text); font-size: 14px; outline: none;"
                               onfocus="this.style.borderColor='var(--color-primary)'" onblur="this.style.borderColor='var(--color-border)'">
                    </div>
                </div>
                <div x-show="nights > 0" style="margin-top: 14px; padding: 10px 14px; background: #F0FDFA; border: 1px solid #CCFBF1; border-radius: 8px;">
                    <span style="color: var(--color-primary); font-size: 14px; font-weight: 600;" x-text="nights + ' {{ __('noches') }} — {{ config('solstay.business.currency_symbol') }}' + (nights * {{ $property->price_per_night }} / 100).toFixed(2)"></span>
                </div>
            </div>

            {{-- Step 2: Guests --}}
            <div x-show="step === 1" x-transition style="background: white; border-radius: 12px; border: 1px solid var(--color-border); padding: 28px; box-shadow: var(--shadow-sm);">
                <h2 style="font-family: 'Poppins', sans-serif; color: var(--color-text); font-size: 18px; font-weight: 600; margin: 0 0 20px 0;">👥 {{ __('Huéspedes') }}</h2>
                <select name="guests" x-model="guests"
                        style="width: 100%; background: white; border: 1px solid var(--color-border); border-radius: 8px; padding: 10px 14px; color: var(--color-text); font-size: 14px; outline: none;">
                    @for($i = 1; $i <= $property->max_guests; $i++)
                        <option value="{{ $i }}">{{ $i }} {{ $i === 1 ? __('huésped') : __('huéspedes') }}</option>
                    @endfor
                </select>
            </div>

            {{-- Step 3: Personal info --}}
            <div x-show="step === 2" x-transition style="background: white; border-radius: 12px; border: 1px solid var(--color-border); padding: 28px; box-shadow: var(--shadow-sm);">
                <h2 style="font-family: 'Poppins', sans-serif; color: var(--color-text); font-size: 18px; font-weight: 600; margin: 0 0 20px 0;">📝 {{ __('Datos personales') }}</h2>
                <div class="grid grid-cols-1 gap-4">
                    @foreach([['guest_name', __('Nombre completo'), 'text', 'guestName', true], ['guest_phone', __('Teléfono'), 'tel', 'guestPhone', true], ['guest_email', __('Email'), 'email', 'guestEmail', false]]  as [$name, $label, $type, $model, $req])
                        <div>
                            <label style="color: var(--color-text-secondary); font-size: 13px; font-weight: 600; display: block; margin-bottom: 6px;">{{ $label }} {{ $req ? '*' : '' }}</label>
                            <input type="{{ $type }}" name="{{ $name }}" x-model="{{ $model }}" {{ $req ? 'required' : '' }}
                                   style="width: 100%; background: white; border: 1px solid var(--color-border); border-radius: 8px; padding: 10px 14px; color: var(--color-text); font-size: 14px; outline: none;"
                                   onfocus="this.style.borderColor='var(--color-primary)'" onblur="this.style.borderColor='var(--color-border)'">
                        </div>
                    @endforeach
                    <div>
                        <label style="color: var(--color-text-secondary); font-size: 13px; font-weight: 600; display: block; margin-bottom: 6px;">{{ __('Notas') }}</label>
                        <textarea name="notes" x-model="notes" rows="3" placeholder="{{ __('Hora de llegada, mascotas, etc.') }}"
                                  style="width: 100%; background: white; border: 1px solid var(--color-border); border-radius: 8px; padding: 10px 14px; color: var(--color-text); font-size: 14px; outline: none; resize: vertical;"
                                  onfocus="this.style.borderColor='var(--color-primary)'" onblur="this.style.borderColor='var(--color-border)'"></textarea>
                    </div>
                </div>
            </div>

            {{-- Step 4: Payment --}}
            <div x-show="step === 3" x-transition style="background: white; border-radius: 12px; border: 1px solid var(--color-border); padding: 28px; box-shadow: var(--shadow-sm);">
                <h2 style="font-family: 'Poppins', sans-serif; color: var(--color-text); font-size: 18px; font-weight: 600; margin: 0 0 20px 0;">💳 {{ __('Método de pago') }}</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <label :style="paymentMethod === 'transfer' ? 'border-color: var(--color-primary); background: #F0FDFA;' : ''"
                           style="cursor: pointer; display: block; background: white; border: 2px solid var(--color-border); border-radius: 12px; padding: 20px; transition: all 0.2s;">
                        <input type="radio" name="payment_method" value="transfer" x-model="paymentMethod" class="hidden">
                        <div style="font-size: 24px; margin-bottom: 8px;">🏦</div>
                        <div style="color: var(--color-text); font-weight: 600; font-size: 15px;">{{ __('Transferencia') }}</div>
                        <div style="color: var(--color-text-secondary); font-size: 12px; margin-top: 4px;">{{ config('solstay.payment.transfer.bank') }}</div>
                    </label>
                    <label :style="paymentMethod === 'bizum' ? 'border-color: var(--color-primary); background: #F0FDFA;' : ''"
                           style="cursor: pointer; display: block; background: white; border: 2px solid var(--color-border); border-radius: 12px; padding: 20px; transition: all 0.2s;">
                        <input type="radio" name="payment_method" value="bizum" x-model="paymentMethod" class="hidden">
                        <div style="font-size: 24px; margin-bottom: 8px;">📱</div>
                        <div style="color: var(--color-text); font-weight: 600; font-size: 15px;">Bizum</div>
                        <div style="color: var(--color-text-secondary); font-size: 12px; margin-top: 4px;">{{ config('solstay.payment.bizum_phone') }}</div>
                    </label>
                </div>
                <div x-show="paymentMethod === 'transfer'" style="margin-top: 16px; padding: 14px; background: var(--color-bg-warm); border-radius: 8px; border: 1px solid var(--color-border);">
                    <p style="color: var(--color-text-secondary); font-size: 13px; margin: 0; line-height: 1.8;">
                        <strong style="color: var(--color-text);">IBAN:</strong> {{ config('solstay.payment.transfer.iban') }}<br>
                        <strong style="color: var(--color-text);">{{ __('Beneficiario') }}:</strong> {{ config('solstay.payment.transfer.beneficiary') }}
                    </p>
                </div>
            </div>

            {{-- Step 5: Summary --}}
            <div x-show="step === 4" x-transition style="background: white; border-radius: 12px; border: 1px solid var(--color-border); padding: 28px; box-shadow: var(--shadow-sm);">
                <h2 style="font-family: 'Poppins', sans-serif; color: var(--color-text); font-size: 18px; font-weight: 600; margin: 0 0 20px 0;">✅ {{ __('Resumen de tu reserva') }}</h2>
                <div style="display: grid; gap: 10px;">
                    @foreach([['Propiedad', $property->name], ['Fechas', ''], ['Noches', ''], ['Huéspedes', '']] as [$label, $val])
                    @endforeach
                    <div class="flex justify-between" style="padding: 8px 0; border-bottom: 1px solid var(--color-border);"><span style="color: var(--color-text-secondary);">{{ __('Propiedad') }}</span><span style="color: var(--color-text); font-weight: 600;">{{ $property->name }}</span></div>
                    <div class="flex justify-between" style="padding: 8px 0; border-bottom: 1px solid var(--color-border);"><span style="color: var(--color-text-secondary);">{{ __('Fechas') }}</span><span style="color: var(--color-text);" x-text="checkIn + ' → ' + checkOut"></span></div>
                    <div class="flex justify-between" style="padding: 8px 0; border-bottom: 1px solid var(--color-border);"><span style="color: var(--color-text-secondary);">{{ __('Noches') }}</span><span style="color: var(--color-text);" x-text="nights"></span></div>
                    <div class="flex justify-between" style="padding: 8px 0; border-bottom: 1px solid var(--color-border);"><span style="color: var(--color-text-secondary);">{{ __('Huéspedes') }}</span><span style="color: var(--color-text);" x-text="guests"></span></div>
                    <div class="flex justify-between" style="padding: 8px 0; border-bottom: 1px solid var(--color-border);"><span style="color: var(--color-text-secondary);">{{ __('Total') }}</span><span style="color: var(--color-accent); font-weight: 700; font-size: 20px;" x-text="'{{ config('solstay.business.currency_symbol') }}' + total.toFixed(2)"></span></div>
                    <div class="flex justify-between" style="padding: 8px 0;"><span style="color: var(--color-text-secondary);">{{ __('Depósito') }} ({{ config('solstay.booking.deposit_percent') }}%)</span><span style="color: #92400E; font-weight: 600;" x-text="'{{ config('solstay.business.currency_symbol') }}' + deposit.toFixed(2)"></span></div>
                </div>
            </div>

            {{-- Nav buttons --}}
            <div class="flex justify-between" style="margin-top: 24px;">
                <button type="button" @click="step--" x-show="step > 0"
                        style="padding: 10px 24px; border-radius: 8px; border: 1px solid var(--color-border); background: white; color: var(--color-text-secondary); font-size: 14px; font-weight: 600; cursor: pointer;">
                    ← {{ __('Anterior') }}
                </button>
                <div x-show="step === 0"></div>
                <button type="button" @click="nextStep()" x-show="step < 4"
                        style="padding: 10px 24px; border-radius: 8px; border: none; background: var(--color-primary); color: white; font-size: 14px; font-weight: 600; cursor: pointer;">
                    {{ __('Siguiente') }} →
                </button>
                <button type="submit" x-show="step === 4"
                        style="padding: 12px 32px; border-radius: 8px; border: none; background: var(--color-accent); color: white; font-size: 16px; font-weight: 700; cursor: pointer; box-shadow: 0 4px 12px rgba(232,87,75,0.25);">
                    ✅ {{ __('Confirmar reserva') }}
                </button>
            </div>
        </form>
    </div>
</section>

<script>
function bookingForm() {
    return {
        step: 0,
        steps: ['{{ __("Fechas") }}', '{{ __("Huéspedes") }}', '{{ __("Datos") }}', '{{ __("Pago") }}', '{{ __("Confirmar") }}'],
        checkIn: '', checkOut: '', guests: 1,
        guestName: '{{ auth()->user()->name }}',
        guestPhone: '{{ auth()->user()->phone }}',
        guestEmail: '{{ auth()->user()->email }}',
        notes: '', paymentMethod: 'transfer',
        get nights() { if (!this.checkIn || !this.checkOut) return 0; return Math.round((new Date(this.checkOut) - new Date(this.checkIn)) / 86400000); },
        get total() { return this.nights * {{ $property->price_per_night }} / 100; },
        get deposit() { return this.total * {{ config('solstay.booking.deposit_percent') }} / 100; },
        get minCheckOut() { if (!this.checkIn) return ''; const d = new Date(this.checkIn); d.setDate(d.getDate() + {{ $property->min_nights }}); return d.toISOString().split('T')[0]; },
        nextStep() {
            if (this.step === 0 && (!this.checkIn || !this.checkOut || this.nights < {{ $property->min_nights }})) return;
            if (this.step === 2 && (!this.guestName || !this.guestPhone)) return;
            if (this.step === 3 && !this.paymentMethod) return;
            this.step++;
        },
        submitForm(el) { el.submit(); }
    };
}
</script>
</x-guest-public>
