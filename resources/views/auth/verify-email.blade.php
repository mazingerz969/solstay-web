<x-guest-layout>
    <div style="margin-bottom: 20px;">
        <h1 style="font-family: 'Poppins', sans-serif; font-size: 24px; font-weight: 700; color: var(--color-text); margin: 0 0 8px 0;">{{ __('Verifica tu email') }}</h1>
        <p style="font-size: 14px; color: var(--color-text-secondary); margin: 0; line-height: 1.5;">
            {{ __('Gracias por registrarte. Te hemos enviado un enlace de verificación a tu correo. Haz clic en él para activar tu cuenta.') }}
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div style="background: #ECFDF5; border: 1px solid #A7F3D0; color: #065F46; padding: 10px 14px; border-radius: 8px; font-size: 13px; margin-bottom: 16px;">
            {{ __('Te hemos enviado un nuevo enlace de verificación.') }}
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <button type="submit" class="auth-btn">{{ __('Reenviar email de verificación') }}</button>
    </form>

    <form method="POST" action="{{ route('logout') }}" style="margin-top: 16px; text-align: center;">
        @csrf
        <button type="submit" style="background: none; border: none; color: var(--color-text-secondary); font-size: 13px; cursor: pointer; text-decoration: underline; font-family: inherit;">
            {{ __('Cerrar sesión') }}
        </button>
    </form>
</x-guest-layout>
