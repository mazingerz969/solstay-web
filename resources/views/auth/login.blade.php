<x-guest-layout>
    <div style="margin-bottom: 24px;">
        <h1 style="font-family: 'Poppins', sans-serif; font-size: 24px; font-weight: 700; color: var(--color-text); margin: 0 0 6px 0;">{{ __('Bienvenido de nuevo') }}</h1>
        <p style="font-size: 14px; color: var(--color-text-secondary); margin: 0;">{{ __('Inicia sesión para gestionar tus reservas') }}</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div style="margin-bottom: 16px;">
            <label for="email" class="auth-label">{{ __('Email') }}</label>
            <input id="email" class="auth-input" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            @error('email')<div class="auth-error">{{ $message }}</div>@enderror
        </div>

        <div style="margin-bottom: 16px;">
            <label for="password" class="auth-label">{{ __('Contraseña') }}</label>
            <input id="password" class="auth-input" type="password" name="password" required autocomplete="current-password">
            @error('password')<div class="auth-error">{{ $message }}</div>@enderror
        </div>

        <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 22px;">
            <label style="display: inline-flex; align-items: center; gap: 8px; font-size: 13px; color: var(--color-text-secondary); cursor: pointer;">
                <input type="checkbox" name="remember" style="accent-color: var(--color-primary);">
                {{ __('Recordarme') }}
            </label>

            @if (Route::has('password.request'))
                <a class="auth-link" href="{{ route('password.request') }}">{{ __('¿Olvidaste tu contraseña?') }}</a>
            @endif
        </div>

        <button type="submit" class="auth-btn">{{ __('Iniciar sesión') }}</button>

        <p style="text-align: center; margin: 22px 0 0; font-size: 13px; color: var(--color-text-secondary);">
            {{ __('¿No tienes cuenta?') }} <a href="{{ route('register') }}" class="auth-link">{{ __('Regístrate') }}</a>
        </p>
    </form>
</x-guest-layout>
