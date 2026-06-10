<x-guest-layout>
    <div x-data="{
            name: '',
            email: '',
            password: '',
            accept: false,
            showPwd: false,
            nameFocused: false,
            emailFocused: false,
            pwdFocused: false,
            get strength() {
                if (!this.password) return 0;
                let s = 0;
                if (this.password.length >= 8) s++;
                if (/[A-Z]/.test(this.password)) s++;
                if (/[0-9]/.test(this.password)) s++;
                if (/[^A-Za-z0-9]/.test(this.password)) s++;
                return s;
            },
            get strengthLabel() {
                return ['', 'DÉBIL', 'ACEPTABLE', 'BUENA', 'EXCELENTE'][this.strength];
            }
         }">

        <div class="ss-eyebrow">EMPIEZA AQUÍ</div>

        <h1 class="ss-h1">Reserva casas que <em>no están</em> en todas partes.</h1>

        <p style="font-size: 15px; color: var(--taupe); margin: 0 0 36px 0; max-width: 42ch; line-height: 1.55;">
            Curamos alojamientos mediterráneos para quienes huyen de lo masivo.
        </p>

        <form method="POST" action="{{ route('register') }}" novalidate>
            @csrf

            <div style="display: flex; flex-direction: column; gap: 22px; margin-bottom: 14px;">

                {{-- Name --}}
                <div class="ss-field"
                     :data-focused="nameFocused"
                     :data-invalid="{{ $errors->has('name') ? 'true' : 'false' }}">
                    <label for="name" class="ss-label">NOMBRE</label>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <input id="name" name="name" type="text" autocomplete="given-name"
                               placeholder="Ej. Lucía" required autofocus
                               value="{{ old('name') }}"
                               x-model="name"
                               @focus="nameFocused = true"
                               @blur="nameFocused = false"
                               class="ss-input">
                    </div>
                    <div class="ss-field-underline"></div>
                    <div style="min-height: 18px; margin-top: 8px;">
                        @error('name')<span class="ss-error">{{ $message }}</span>@enderror
                    </div>
                </div>

                {{-- Email --}}
                <div class="ss-field"
                     :data-focused="emailFocused"
                     :data-invalid="{{ $errors->has('email') ? 'true' : 'false' }}">
                    <label for="email" class="ss-label">CORREO ELECTRÓNICO</label>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <input id="email" name="email" type="email" autocomplete="email"
                               placeholder="tu@correo.com" required
                               value="{{ old('email') }}"
                               x-model="email"
                               @focus="emailFocused = true"
                               @blur="emailFocused = false"
                               class="ss-input">
                    </div>
                    <div class="ss-field-underline"></div>
                    <div style="min-height: 18px; margin-top: 8px;">
                        @error('email')<span class="ss-error">{{ $message }}</span>@enderror
                    </div>
                </div>

                {{-- Password + strength --}}
                <div>
                    <div class="ss-field"
                         :data-focused="pwdFocused"
                         :data-invalid="{{ $errors->has('password') ? 'true' : 'false' }}">
                        <label for="password" class="ss-label">CONTRASEÑA</label>
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <input id="password" name="password" :type="showPwd ? 'text' : 'password'"
                                   autocomplete="new-password" required
                                   x-model="password"
                                   @focus="pwdFocused = true"
                                   @blur="pwdFocused = false"
                                   class="ss-input">
                            <button type="button" class="ss-eye-btn"
                                    @click="showPwd = !showPwd"
                                    :aria-label="showPwd ? 'Ocultar contraseña' : 'Mostrar contraseña'">
                                <svg x-show="!showPwd" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M2.5 12s3.5-6.5 9.5-6.5S21.5 12 21.5 12s-3.5 6.5-9.5 6.5S2.5 12 2.5 12Z" />
                                    <circle cx="12" cy="12" r="2.75" />
                                </svg>
                                <svg x-show="showPwd" x-cloak width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 4l16 16" />
                                    <path d="M10.5 6.2A11 11 0 0 1 12 6c6 0 9.5 6 9.5 6a16.2 16.2 0 0 1-3.1 3.8" />
                                    <path d="M6.3 7.8A16.3 16.3 0 0 0 2.5 12s3.5 6 9.5 6a10.6 10.6 0 0 0 4-.77" />
                                    <path d="M9.8 9.9a3 3 0 0 0 4.3 4.2" />
                                </svg>
                            </button>
                        </div>
                        <div class="ss-field-underline"></div>
                        <div style="min-height: 18px; margin-top: 8px;">
                            @error('password')<span class="ss-error">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <div x-show="password" x-cloak x-transition.opacity
                         aria-live="polite"
                         style="display: flex; align-items: center; gap: 12px; margin-top: -6px; margin-bottom: 2px;">
                        <div style="display: flex; gap: 4px; flex: 1;">
                            <template x-for="i in [1,2,3,4]" :key="i">
                                <span class="ss-strength-bar"
                                      :data-level="strength"
                                      :class="{ 'on': i <= strength }"></span>
                            </template>
                        </div>
                        <span x-text="strengthLabel"
                              style="font-size: 10.5px; font-weight: 500; letter-spacing: var(--tracking-caps); color: var(--taupe);"></span>
                    </div>
                </div>

                {{-- Password confirmation --}}
                <div class="ss-field"
                     :data-invalid="{{ $errors->has('password_confirmation') ? 'true' : 'false' }}">
                    <label for="password_confirmation" class="ss-label">CONFIRMAR CONTRASEÑA</label>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <input id="password_confirmation" name="password_confirmation" type="password"
                               autocomplete="new-password" required class="ss-input">
                    </div>
                    <div class="ss-field-underline"></div>
                    <div style="min-height: 18px; margin-top: 8px;">
                        @error('password_confirmation')<span class="ss-error">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>

            {{-- Accept terms --}}
            <div style="margin: 14px 0 28px 0;">
                <label for="accept" class="ss-check"
                       :data-checked="accept"
                       style="display: inline-flex; align-items: flex-start; gap: 10px; cursor: pointer; user-select: none; line-height: 1.4; position: relative;">
                    <input id="accept" name="accept" type="checkbox" required
                           x-model="accept"
                           style="position: absolute; opacity: 0; pointer-events: none;">
                    <span class="ss-check-box" aria-hidden="true">
                        <svg x-show="accept" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 12.5l5 5 11-11" />
                        </svg>
                    </span>
                    <span style="font-size: 13.5px; color: var(--ink);">
                        Acepto los <a href="/terminos" class="ss-link-inline">términos</a>
                        y la <a href="/privacidad" class="ss-link-inline">política de privacidad</a>.
                    </span>
                </label>
                @error('accept')<div class="ss-error" style="margin-top: 8px;">{{ $message }}</div>@enderror
            </div>

            {{-- Primary button --}}
            <button type="submit" class="ss-btn-primary">
                <span>Crear cuenta</span>
                <svg class="ss-btn-arrow" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 12h16" />
                    <path d="M14 6l6 6-6 6" />
                </svg>
            </button>

            {{-- Divider --}}
            <div style="display: flex; align-items: center; gap: 16px; margin: 26px 0;">
                <span style="flex: 1; height: 1px; background: var(--olive-soft); opacity: 0.45;"></span>
                <span style="font-size: 10.5px; font-weight: 500; letter-spacing: var(--tracking-caps); color: var(--taupe); text-transform: uppercase;">O BIEN</span>
                <span style="flex: 1; height: 1px; background: var(--olive-soft); opacity: 0.45;"></span>
            </div>

            {{-- Google button --}}
            <button type="button" class="ss-btn-outlined" onclick="alert('Integración Google pendiente')">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20.5 12a8.5 8.5 0 1 1-2.7-6.2" />
                    <path d="M20.5 6.2V12h-5.6" />
                </svg>
                <span>Continuar con Google</span>
            </button>

            <p style="font-size: 14px; color: var(--taupe); margin: 36px 0 0;">
                ¿Ya tienes cuenta?
                <a href="{{ route('login') }}" class="ss-link-strong">Entrar</a>
            </p>
        </form>
    </div>
</x-guest-layout>
