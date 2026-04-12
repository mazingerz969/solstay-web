<x-guest-layout>
    <div style="margin-bottom: 20px;">
        <h1 style="font-family: 'Poppins', sans-serif; font-size: 24px; font-weight: 700; color: var(--color-text); margin: 0 0 8px 0;">{{ __('Recuperar contraseña') }}</h1>
        <p style="font-size: 14px; color: var(--color-text-secondary); margin: 0; line-height: 1.5;">{{ __('Introduce tu email y te enviaremos un enlace para restablecer tu contraseña.') }}</p>
    </div>

    @if (session('status'))
        <div style="background: #ECFDF5; border: 1px solid #A7F3D0; color: #065F46; padding: 10px 14px; border-radius: 8px; font-size: 13px; margin-bottom: 16px;">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div style="margin-bottom: 20px;">
            <label for="email" class="auth-label">{{ __('Email') }}</label>
            <input id="email" class="auth-input" type="email" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')<div class="auth-error">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="auth-btn">{{ __('Enviar enlace') }}</button>

        <p style="text-align: center; margin: 22px 0 0; font-size: 13px; color: var(--color-text-secondary);">
            <a href="{{ route('login') }}" class="auth-link">{{ __('← Volver al inicio de sesión') }}</a>
        </p>
    </form>
</x-guest-layout>
