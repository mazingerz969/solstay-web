<x-guest-layout>
    <div style="margin-bottom: 24px;">
        <h1 style="font-family: 'Poppins', sans-serif; font-size: 24px; font-weight: 700; color: var(--color-text); margin: 0 0 6px 0;">{{ __('Crea tu cuenta') }}</h1>
        <p style="font-size: 14px; color: var(--color-text-secondary); margin: 0;">{{ __('Empieza a reservar tu próxima escapada') }}</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div style="margin-bottom: 16px;">
            <label for="name" class="auth-label">{{ __('Nombre completo') }}</label>
            <input id="name" class="auth-input" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name">
            @error('name')<div class="auth-error">{{ $message }}</div>@enderror
        </div>

        <div style="margin-bottom: 16px;">
            <label for="email" class="auth-label">{{ __('Email') }}</label>
            <input id="email" class="auth-input" type="email" name="email" value="{{ old('email') }}" required autocomplete="username">
            @error('email')<div class="auth-error">{{ $message }}</div>@enderror
        </div>

        <div style="margin-bottom: 16px;">
            <label for="password" class="auth-label">{{ __('Contraseña') }}</label>
            <input id="password" class="auth-input" type="password" name="password" required autocomplete="new-password">
            @error('password')<div class="auth-error">{{ $message }}</div>@enderror
        </div>

        <div style="margin-bottom: 22px;">
            <label for="password_confirmation" class="auth-label">{{ __('Confirmar contraseña') }}</label>
            <input id="password_confirmation" class="auth-input" type="password" name="password_confirmation" required autocomplete="new-password">
            @error('password_confirmation')<div class="auth-error">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="auth-btn">{{ __('Crear cuenta') }}</button>

        <p style="text-align: center; margin: 22px 0 0; font-size: 13px; color: var(--color-text-secondary);">
            {{ __('¿Ya tienes cuenta?') }} <a href="{{ route('login') }}" class="auth-link">{{ __('Inicia sesión') }}</a>
        </p>
    </form>
</x-guest-layout>
