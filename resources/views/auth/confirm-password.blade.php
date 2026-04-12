<x-guest-layout>
    <div style="margin-bottom: 20px;">
        <h1 style="font-family: 'Poppins', sans-serif; font-size: 24px; font-weight: 700; color: var(--color-text); margin: 0 0 8px 0;">{{ __('Confirmar contraseña') }}</h1>
        <p style="font-size: 14px; color: var(--color-text-secondary); margin: 0; line-height: 1.5;">{{ __('Esta es un área segura. Por favor confirma tu contraseña para continuar.') }}</p>
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div style="margin-bottom: 22px;">
            <label for="password" class="auth-label">{{ __('Contraseña') }}</label>
            <input id="password" class="auth-input" type="password" name="password" required autocomplete="current-password" autofocus>
            @error('password')<div class="auth-error">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="auth-btn">{{ __('Confirmar') }}</button>
    </form>
</x-guest-layout>
