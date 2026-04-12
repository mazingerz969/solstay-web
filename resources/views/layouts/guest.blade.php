<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SolStay') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|poppins:600,700,800&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --color-primary: #1B8B8C;
            --color-primary-hover: #156F70;
            --color-accent: #E8574B;
            --color-text: #2C3E50;
            --color-text-secondary: #7F8C8D;
            --color-bg: #FFFFFF;
            --color-bg-warm: #F8FAFB;
            --color-border: #E1E8ED;
            --shadow-lg: 0 8px 24px rgba(0,0,0,0.08);
        }
        .auth-input {
            width: 100%;
            padding: 11px 14px;
            border: 1px solid var(--color-border);
            border-radius: 8px;
            font-size: 14px;
            color: var(--color-text);
            background: white;
            outline: none;
            transition: border-color 0.15s, box-shadow 0.15s;
            box-sizing: border-box;
        }
        .auth-input:focus {
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(27,139,140,0.12);
        }
        .auth-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--color-text);
            margin-bottom: 6px;
        }
        .auth-btn {
            width: 100%;
            background: var(--color-primary);
            color: white;
            border: none;
            font-size: 14px;
            font-weight: 600;
            padding: 12px 20px;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.2s;
            font-family: inherit;
        }
        .auth-btn:hover { background: var(--color-primary-hover); }
        .auth-link {
            color: var(--color-primary);
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
        }
        .auth-link:hover { text-decoration: underline; }
        .auth-error {
            color: #DC2626;
            font-size: 13px;
            margin-top: 6px;
        }
    </style>
</head>
<body style="background: linear-gradient(135deg, #f0f9f9 0%, #e8f4f8 50%, #fef3f0 100%); color: var(--color-text); font-family: 'Inter', sans-serif; margin: 0; min-height: 100vh;">
    <div style="min-height: 100vh; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 24px;">
        <a href="/" style="text-decoration: none; display: flex; align-items: center; gap: 10px; margin-bottom: 28px;">
            <div style="background: var(--color-primary); width: 44px; height: 44px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 20px; color: white; font-family: 'Poppins', sans-serif;">S</div>
            <span style="font-size: 24px; font-weight: 700; color: var(--color-text); font-family: 'Poppins', sans-serif;">Sol<span style="color: var(--color-primary);">Stay</span></span>
        </a>

        <div style="width: 100%; max-width: 440px; background: white; border-radius: 16px; padding: 36px 32px; box-shadow: var(--shadow-lg); border: 1px solid var(--color-border);">
            {{ $slot }}
        </div>

        <p style="margin-top: 24px; font-size: 13px; color: var(--color-text-secondary);">
            &copy; {{ date('Y') }} SolStay. {{ __('Todos los derechos reservados.') }}
        </p>
    </div>
</body>
</html>
