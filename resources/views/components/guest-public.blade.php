<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('favicon-32.png') }}">
    <title>{{ $title ?? 'SolStay' }} — SolStay</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=poppins:400,500,600,700,800&family=inter:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --color-primary: #1B8B8C;
            --color-primary-light: #3DBDBE;
            --color-accent: #E8574B;
            --color-accent-hover: #D04437;
            --color-text: #2C3E50;
            --color-text-secondary: #7F8C8D;
            --color-text-light: #BDC3C7;
            --color-bg: #FFFFFF;
            --color-bg-warm: #F8FAFB;
            --color-border: #E1E8ED;
            --shadow-sm: 0 2px 4px rgba(0,0,0,0.06);
            --shadow-md: 0 4px 12px rgba(0,0,0,0.08);
            --shadow-lg: 0 8px 24px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body style="background: var(--color-bg); color: var(--color-text); font-family: 'Inter', sans-serif; margin: 0;">

    {{-- Navigation --}}
    <nav style="background: white; border-bottom: 1px solid var(--color-border); position: sticky; top: 0; z-index: 50;">
        <div class="max-w-7xl mx-auto flex items-center justify-between" style="padding: 14px 24px;">
            <a href="{{ route('landing') }}" class="flex items-center gap-2" style="text-decoration: none;">
                <img src="{{ asset('logo.png') }}" alt="SolStay" style="width: 36px; height: 36px; border-radius: 8px;">
                <span style="font-size: 20px; font-weight: 700; color: var(--color-text); font-family: 'Poppins', sans-serif;">Sol<span style="color: var(--color-primary);">Stay</span></span>
            </a>

            <div class="hidden md:flex items-center gap-6">
                <a href="{{ route('properties.index') }}" style="color: var(--color-text-secondary); text-decoration: none; font-size: 14px; font-weight: 500; transition: color 0.2s;"
                   onmouseover="this.style.color='var(--color-primary)'" onmouseout="this.style.color='var(--color-text-secondary)'">
                    {{ __('Propiedades') }}
                </a>
                @auth
                    <a href="{{ route('dashboard') }}" style="color: var(--color-text-secondary); text-decoration: none; font-size: 14px; font-weight: 500;">{{ __('Mi Panel') }}</a>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" style="color: var(--color-text-secondary); text-decoration: none; font-size: 14px; font-weight: 500;">Admin</a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" style="background: none; border: none; color: var(--color-text-secondary); font-size: 14px; font-weight: 500; cursor: pointer;">{{ __('Salir') }}</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" style="color: var(--color-text-secondary); text-decoration: none; font-size: 14px; font-weight: 500;">{{ __('Entrar') }}</a>
                    <a href="{{ route('register') }}" style="background: var(--color-accent); color: white; text-decoration: none; font-size: 14px; font-weight: 600; padding: 8px 20px; border-radius: 8px; transition: background 0.2s;"
                       onmouseover="this.style.background='var(--color-accent-hover)'" onmouseout="this.style.background='var(--color-accent)'">
                        {{ __('Registrarse') }}
                    </a>
                @endauth
                <x-locale-switcher />
            </div>

            {{-- Mobile --}}
            <div class="md:hidden" x-data="{ open: false }">
                <button @click="open = !open" style="background: none; border: none; color: var(--color-text); cursor: pointer; padding: 8px;">
                    <svg width="24" height="24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 12h18M3 6h18M3 18h18"/></svg>
                </button>
                <div x-show="open" @click.away="open = false" x-transition
                     class="absolute right-4 mt-2" style="background: white; border: 1px solid var(--color-border); border-radius: 12px; padding: 8px; min-width: 200px; box-shadow: var(--shadow-lg);">
                    <a href="{{ route('properties.index') }}" style="display: block; padding: 10px 16px; color: var(--color-text); text-decoration: none; font-size: 14px; border-radius: 8px;">{{ __('Propiedades') }}</a>
                    @auth
                        <a href="{{ route('dashboard') }}" style="display: block; padding: 10px 16px; color: var(--color-text); text-decoration: none; font-size: 14px;">{{ __('Mi Panel') }}</a>
                    @else
                        <a href="{{ route('login') }}" style="display: block; padding: 10px 16px; color: var(--color-text); text-decoration: none; font-size: 14px;">{{ __('Entrar') }}</a>
                        <a href="{{ route('register') }}" style="display: block; padding: 10px 16px; color: var(--color-accent); text-decoration: none; font-size: 14px; font-weight: 600;">{{ __('Registrarse') }}</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- Content --}}
    <main>
        {{ $slot }}
    </main>

    {{-- Footer --}}
    <footer style="background: var(--color-bg-warm); border-top: 1px solid var(--color-border); margin-top: 80px;">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8" style="padding: 48px 24px;">
            <div>
                <div class="flex items-center gap-2" style="margin-bottom: 12px;">
                    <img src="{{ asset('logo.png') }}" alt="SolStay" style="width: 28px; height: 28px; border-radius: 6px;">
                    <span style="font-size: 16px; font-weight: 700; color: var(--color-text); font-family: 'Poppins', sans-serif;">SolStay</span>
                </div>
                <p style="color: var(--color-text-secondary); font-size: 14px; line-height: 1.6;">{{ config('solstay.business.description_' . app()->getLocale()) }}</p>
            </div>
            <div>
                <h4 style="color: var(--color-text); font-size: 14px; font-weight: 600; margin-bottom: 12px;">{{ __('Contacto') }}</h4>
                <p style="color: var(--color-text-secondary); font-size: 14px; line-height: 2;">
                    {{ config('solstay.business.email') }}<br>{{ config('solstay.business.phone') }}
                </p>
            </div>
            <div>
                <h4 style="color: var(--color-text); font-size: 14px; font-weight: 600; margin-bottom: 12px;">{{ __('Legal') }}</h4>
                <p style="color: var(--color-text-secondary); font-size: 14px; line-height: 2;">
                    <a href="#" style="color: var(--color-text-secondary); text-decoration: none;">{{ __('Privacidad') }}</a><br>
                    <a href="#" style="color: var(--color-text-secondary); text-decoration: none;">{{ __('Términos') }}</a>
                </p>
            </div>
        </div>
        <div style="border-top: 1px solid var(--color-border); padding: 16px 24px; text-align: center;">
            <p style="color: var(--color-text-light); font-size: 13px;">&copy; {{ date('Y') }} SolStay. {{ __('Todos los derechos reservados.') }}</p>
        </div>
    </footer>

</body>
</html>
