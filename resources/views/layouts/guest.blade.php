<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'SolStay') }}</title>

    <link rel="icon" type="image/png" href="{{ asset('favicon-32.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,500;0,9..144,600;1,9..144,400;1,9..144,500&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>

    <style>
        :root {
            --sand: #FAF6F0;
            --sand-deep: #F3ECDF;
            --border: #E8E2D5;
            --border-strong: #D8CFBD;
            --terracotta: #B8552C;
            --terracotta-deep: #9A4521;
            --olive: #6B7A3F;
            --olive-soft: #A8B07A;
            --ink: #1A1815;
            --taupe: #8B7E70;
            --taupe-soft: #B2A89C;
            --danger: #A83E2B;
            --white: #FFFCF6;
            --tracking-caps: 0.08em;
            --t-smooth: cubic-bezier(.4,0,.2,1);
        }

        * { box-sizing: border-box; }
        html, body { margin: 0; padding: 0; }
        body {
            font-family: "Inter", -apple-system, BlinkMacSystemFont, sans-serif;
            color: var(--ink);
            background: var(--sand);
            font-size: 15px;
            line-height: 1.55;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* Photo panel overlay + quote */
        .ss-photo-overlay {
            position: absolute; inset: 0;
            background:
              linear-gradient(to top right, rgba(26,24,21,.72) 0%, rgba(26,24,21,.25) 45%, rgba(26,24,21,0) 65%),
              linear-gradient(to top, rgba(184,85,44,.18) 0%, rgba(0,0,0,0) 45%);
            pointer-events: none;
        }

        /* Eyebrow with leading rule */
        .ss-eyebrow {
            font-size: 11px; font-weight: 500; letter-spacing: var(--tracking-caps);
            text-transform: uppercase; color: var(--taupe);
            margin-bottom: 18px; position: relative; padding-left: 28px;
        }
        .ss-eyebrow::before {
            content: ""; position: absolute; left: 0; top: 50%;
            width: 20px; height: 1px; background: var(--taupe); transform: translateY(-50%);
        }

        /* H1 Fraunces with italic em terracotta */
        .ss-h1 {
            font-family: "Fraunces", serif; font-weight: 400;
            font-size: 40px; line-height: 1.1; letter-spacing: -0.015em;
            color: var(--ink); margin: 0 0 16px 0; text-wrap: balance;
        }
        .ss-h1 em { font-style: italic; font-weight: 400; color: var(--terracotta); }

        /* Underline fields */
        .ss-field { position: relative; }
        .ss-label {
            display: block; font-size: 11px; font-weight: 500;
            letter-spacing: var(--tracking-caps); text-transform: uppercase;
            color: var(--taupe); margin-bottom: 10px;
            transition: color 180ms var(--t-smooth);
        }
        .ss-field[data-focused="true"] .ss-label { color: var(--terracotta); }
        .ss-field[data-invalid="true"] .ss-label { color: var(--danger); }

        .ss-input {
            flex: 1; appearance: none; border: 0; background: transparent;
            padding: 6px 0 10px 0; font-family: "Inter", sans-serif;
            font-size: 16px; color: var(--ink); outline: none; width: 100%;
            letter-spacing: -0.003em;
        }
        .ss-input::placeholder { color: var(--taupe-soft); }

        .ss-field-underline { position: relative; height: 1px; background: var(--border-strong); }
        .ss-field-underline::after {
            content: ""; position: absolute; left: 0; right: 0; bottom: 0;
            height: 2px; background: var(--terracotta);
            transform: scaleX(0); transform-origin: left center;
            transition: transform 280ms var(--t-smooth);
        }
        .ss-field[data-focused="true"] .ss-field-underline::after { transform: scaleX(1); }
        .ss-field[data-invalid="true"] .ss-field-underline::after {
            background: var(--danger); transform: scaleX(1);
        }

        .ss-error {
            font-size: 12px; color: var(--danger);
            animation: solstay-shake 220ms var(--t-smooth);
        }
        @keyframes solstay-shake {
            0%,100% { transform: translateX(0); }
            25% { transform: translateX(-3px); }
            75% { transform: translateX(3px); }
        }

        .ss-eye-btn {
            background: transparent; border: 0; padding: 6px; color: var(--taupe);
            cursor: pointer; transition: color 160ms var(--t-smooth);
            display: inline-flex; margin-bottom: 4px;
        }
        .ss-eye-btn:hover { color: var(--ink); }

        /* Password strength bars */
        .ss-strength-bar { height: 2px; flex: 1; background: var(--border); transition: background 220ms var(--t-smooth); }
        .ss-strength-bar[data-level="1"].on { background: var(--danger); }
        .ss-strength-bar[data-level="2"].on { background: #C47A3E; }
        .ss-strength-bar[data-level="3"].on,
        .ss-strength-bar[data-level="4"].on { background: var(--olive); }

        /* Checkbox */
        .ss-check-box {
            width: 16px; height: 16px; border: 1px solid var(--border-strong);
            background: var(--sand); display: inline-flex; align-items: center;
            justify-content: center; flex: 0 0 16px; margin-top: 1px;
            transition: all 160ms var(--t-smooth); color: var(--sand);
        }
        .ss-check[data-checked="true"] .ss-check-box {
            background: var(--terracotta); border-color: var(--terracotta);
        }
        .ss-check:hover .ss-check-box { border-color: var(--ink); }
        .ss-check[data-checked="true"]:hover .ss-check-box { background: var(--terracotta-deep); border-color: var(--terracotta-deep); }

        /* Links */
        .ss-link-strong {
            color: var(--terracotta); font-weight: 600; text-decoration: none;
            border-bottom: 1px solid var(--terracotta); padding-bottom: 1px;
            transition: all 160ms var(--t-smooth);
        }
        .ss-link-strong:hover { color: var(--terracotta-deep); border-bottom-color: var(--terracotta-deep); }
        .ss-link-inline {
            color: var(--ink); text-decoration: none;
            border-bottom: 1px solid var(--border-strong); padding-bottom: 1px;
        }
        .ss-link-inline:hover { color: var(--terracotta); border-bottom-color: var(--terracotta); }
        .ss-link-caps {
            font-size: 11px; font-weight: 500; letter-spacing: var(--tracking-caps);
            color: var(--ink); text-decoration: none;
            border-bottom: 1px solid transparent; transition: all 160ms;
        }
        .ss-link-caps:hover { color: var(--terracotta); border-bottom-color: var(--terracotta); }

        /* Primary + outlined buttons */
        .ss-btn-primary {
            height: 56px; background: var(--terracotta); color: var(--sand);
            border: 0; font-family: "Inter", sans-serif; font-weight: 600;
            font-size: 14px; letter-spacing: 0.01em; cursor: pointer; width: 100%;
            display: inline-flex; align-items: center; justify-content: center; gap: 10px;
            transition: background 180ms var(--t-smooth), transform 180ms var(--t-smooth);
        }
        .ss-btn-primary:hover { background: var(--terracotta-deep); }
        .ss-btn-primary:active { transform: scale(0.99); }
        .ss-btn-primary:disabled { opacity: 0.7; cursor: not-allowed; }
        .ss-btn-primary .ss-btn-arrow { transition: transform 220ms var(--t-smooth); }
        .ss-btn-primary:hover .ss-btn-arrow { transform: translateX(3px); }

        .ss-btn-outlined {
            height: 56px; background: transparent; color: var(--ink);
            border: 1px solid var(--border-strong); font-family: "Inter", sans-serif;
            font-weight: 500; font-size: 14px; cursor: pointer; width: 100%;
            display: inline-flex; align-items: center; justify-content: center; gap: 12px;
            transition: border-color 180ms, background 180ms;
        }
        .ss-btn-outlined:hover { border-color: var(--ink); background: var(--sand-deep); }

        /* Animations */
        @keyframes solstay-fade {
            from { opacity: 0; transform: translateY(6px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes solstay-spin { to { transform: rotate(360deg); } }
        .ss-spin { animation: solstay-spin 0.9s linear infinite; }

        [x-cloak] { display: none !important; }

        /* Responsive: collapse photo panel under 900px */
        @media (max-width: 900px) {
            .ss-frame { grid-template-columns: 100% !important; }
            .ss-photo-panel { display: none !important; }
            .ss-form-panel { padding: 40px 28px !important; }
        }
    </style>
</head>
<body style="background: var(--sand); min-height: 100vh;">
    <div class="ss-frame" style="min-height: 100vh; display: grid; grid-template-columns: 60% 40%; grid-template-rows: 100%; align-items: stretch; position: relative;">

        {{-- PHOTO PANEL (left 60%) --}}
        <aside class="ss-photo-panel" aria-label="Casa mediterránea al atardecer"
               style="position: relative; overflow: hidden; color: var(--white); min-height: 100vh;
                      background: linear-gradient(160deg, #E8B97A 0%, #C88F5E 30%, #A85A3A 60%, #5C3020 100%);">

            <div style="position: absolute; inset: 0; background-image: url('{{ asset('img/auth/hero.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;"></div>

            <div class="ss-photo-overlay"></div>

            {{-- Top eyebrow --}}
            <div style="position: absolute; top: 40px; left: 48px; display: flex; align-items: center; gap: 12px;">
                <span style="font-size: 11px; font-weight: 500; letter-spacing: var(--tracking-caps); color: rgba(255,252,246,.85); text-transform: uppercase; padding: 6px 10px; border: 1px solid rgba(255,252,246,.35); border-radius: 2px; backdrop-filter: blur(4px);">
                    SOLSTAY · MEDITERRÁNEO
                </span>
            </div>

            {{-- Bottom-left quote --}}
            <figure style="position: absolute; left: 48px; bottom: 56px; right: 120px; margin: 0; color: var(--white); z-index: 2;">
                <blockquote style="font-family: 'Fraunces', serif; font-style: italic; font-weight: 400; font-size: 30px; line-height: 1.3; margin: 0 0 18px 0; letter-spacing: -0.005em; color: #FBF4E4; text-shadow: 0 2px 20px rgba(0,0,0,0.35); max-width: 520px;">
                    <span aria-hidden="true" style="font-family: 'Fraunces', serif; font-style: italic; font-size: 44px; line-height: 0; margin-right: 4px; color: #F6D9B1; vertical-align: -8px;">"</span>
                    Un rincón del Mediterráneo, tuyo por unos días.
                </blockquote>
                <figcaption style="display: flex; align-items: center; gap: 10px;">
                    <span style="font-size: 11px; font-weight: 500; letter-spacing: var(--tracking-caps); text-transform: uppercase; color: rgba(255,252,246,0.78);">Mallorca</span>
                    <span style="color: rgba(255,252,246,0.55); font-size: 12px;">·</span>
                    <span style="font-size: 11px; font-weight: 500; letter-spacing: var(--tracking-caps); text-transform: uppercase; color: rgba(255,252,246,0.78);">Islas Baleares</span>
                </figcaption>
            </figure>
        </aside>

        {{-- FORM PANEL (right 40%) --}}
        <section class="ss-form-panel" style="position: relative; padding: 72px; display: flex; flex-direction: column; background: var(--sand); min-height: 100vh;">

            {{-- Top: wordmark + meta --}}
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 56px;">
                <a href="/" aria-label="SolStay"
                   style="text-decoration: none; display: inline-flex; align-items: baseline; font-family: 'Fraunces', serif; font-weight: 500; font-size: 24px; letter-spacing: -0.01em; line-height: 1;">
                    <span style="color: var(--ink);">Sol</span>
                    {{-- Hand-drawn sun glyph --}}
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#B8552C" stroke-width="1.3" stroke-linecap="round" aria-hidden="true" style="display: inline-block; vertical-align: -3px; margin: 0 2px;">
                        <circle cx="12" cy="12" r="3.4" />
                        <path d="M12 3.2v2.4 M12 18.4v2.4 M3.2 12h2.4 M18.4 12h2.4" />
                        <path d="M5.6 5.6l1.7 1.7 M16.7 16.7l1.7 1.7 M5.6 18.4l1.7-1.7 M16.7 7.3l1.7-1.7" />
                    </svg>
                    <span style="color: var(--terracotta);">Stay</span>
                </a>
                <span style="font-size: 11px; font-weight: 500; letter-spacing: var(--tracking-caps); text-transform: uppercase; color: var(--taupe);">
                    EST · 2026
                </span>
            </div>

            {{-- Form content --}}
            <div style="animation: solstay-fade 420ms var(--t-smooth); display: flex; flex-direction: column; flex: 1;">
                {{ $slot }}
            </div>

            {{-- Footer --}}
            <p style="font-size: 12px; color: var(--taupe); margin: 48px 0 0; letter-spacing: 0.01em;">
                &copy; {{ date('Y') }} SolStay. Curado en el Mediterráneo.
            </p>
        </section>
    </div>
</body>
</html>
