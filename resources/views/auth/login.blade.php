<x-guest-layout>
    <div x-data="{
            email: '',
            password: '',
            remember: true,
            showPwd: false,
            emailFocused: false,
            pwdFocused: false
         }">

        <div class="ss-eyebrow">BIENVENIDO DE NUEVO</div>

        <h1 class="ss-h1">Continúa donde lo <em>dejaste</em>.</h1>

        <p style="font-size: 15px; color: var(--taupe); margin: 0 0 36px 0; max-width: 42ch; line-height: 1.55;">
            Accede a tus casas guardadas, reservas en curso y recomendaciones hechas a mano por nuestro equipo.
        </p>

        <x-auth-session-status :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" novalidate>
            @csrf

            <div style="display: flex; flex-direction: column; gap: 22px; margin-bottom: 14px;">

                {{-- Email --}}
                <div class="ss-field"
                     :data-focused="emailFocused"
                     :data-invalid="{{ $errors->has('email') ? 'true' : 'false' }}">
                    <label for="email" class="ss-label">CORREO ELECTRÓNICO</label>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <input id="email" name="email" type="email" autocomplete="username"
                               placeholder="tu@correo.com" required autofocus
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

                {{-- Password --}}
                <div class="ss-field"
                     :data-focused="pwdFocused"
                     :data-invalid="{{ $errors->has('password') ? 'true' : 'false' }}">
                    <label for="password" class="ss-label">CONTRASEÑA</label>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <input id="password" name="password" :type="showPwd ? 'text' : 'password'"
                               autocomplete="current-password" required
                               x-model="password"
                               @focus="pwdFocused = true"
                               @blur="pwdFocused = false"
                               class="ss-input">
                        <button type="button" class="ss-eye-btn"
                                @click="showPwd = !showPwd"
                                :aria-label="showPwd ? 'Ocultar contraseña' : 'Mostrar contraseña'">
                            {{-- Eye --}}
                            <svg x-show="!showPwd" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M2.5 12s3.5-6.5 9.5-6.5S21.5 12 21.5 12s-3.5 6.5-9.5 6.5S2.5 12 2.5 12Z" />
                                <circle cx="12" cy="12" r="2.75" />
                            </svg>
                            {{-- Eye off --}}
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
            </div>

            {{-- Remember + forgot --}}
            <div style="display: flex; align-items: center; justify-content: space-between; margin: 10px 0 28px 0;">
                <label for="remember" class="ss-check"
                       :data-checked="remember"
                       style="display: inline-flex; align-items: flex-start; gap: 10px; cursor: pointer; user-select: none; line-height: 1.4;">
                    <input id="remember" name="remember" type="checkbox"
                           x-model="remember"
                           style="position: absolute; opacity: 0; pointer-events: none;">
                    <span class="ss-check-box" aria-hidden="true">
                        <svg x-show="remember" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 12.5l5 5 11-11" />
                        </svg>
                    </span>
                    <span style="font-size: 13.5px; color: var(--ink);">Recuérdame</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="ss-link-caps">¿OLVIDASTE TU CONTRASEÑA?</a>
                @endif
            </div>

            {{-- Primary button --}}
            <button type="submit" class="ss-btn-primary">
                <span>Entrar</span>
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

            <p style="font-size: 14px; color: var(--taupe); margin: 36px 0 0; text-align: left;">
                ¿Primera vez en SolStay?
                <a href="{{ route('register') }}" class="ss-link-strong">Crear una cuenta</a>
            </p>
        </form>
    </div>
</x-guest-layout>
