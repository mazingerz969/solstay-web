<x-guest-layout>
    <div style="margin-bottom: 24px;">
        <h1 style="font-family: 'Poppins', sans-serif; font-size: 24px; font-weight: 700; color: var(--color-text); margin: 0 0 6px 0;">{{ __('Nueva contraseña') }}</h1>
        <p style="font-size: 14px; color: var(--color-text-secondary); margin: 0;">{{ __('Elige una contraseña segura para tu cuenta') }}</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div style="margin-bottom: 16px;">
            <label for="email" class="auth-label">{{ __('Email') }}</label>
            <input id="email" class="auth-input" type="email" name="email" value="{{ old('email', $request->email) }}" required autofocus autocomplete="username">
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

        <button type="submit" class="auth-btn">{{ __('Restablecer contraseña') }}</button>
    </form>
</x-guest-layout>
