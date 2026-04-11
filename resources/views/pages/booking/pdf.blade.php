<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><style>body{font-family:sans-serif;color:#333;font-size:14px}h1{color:#0d9488;font-size:24px}table{width:100%;border-collapse:collapse;margin:20px 0}td{padding:8px 12px;border-bottom:1px solid #eee}.label{color:#888;width:40%}.value{font-weight:600}.total{font-size:18px;color:#0d9488;font-weight:700}.header{text-align:center;margin-bottom:30px;padding-bottom:20px;border-bottom:2px solid #0d9488}</style></head>
<body>
    <div class="header">
        <h1>SolStay — Confirmación de Reserva</h1>
        <p>Referencia: #{{ $booking->id }}</p>
    </div>

    <table>
        <tr><td class="label">Propiedad</td><td class="value">{{ $booking->property->name_es }}</td></tr>
        <tr><td class="label">Dirección</td><td class="value">{{ $booking->property->address }}</td></tr>
        <tr><td class="label">Check-in</td><td class="value">{{ $booking->check_in->format('d/m/Y') }}</td></tr>
        <tr><td class="label">Check-out</td><td class="value">{{ $booking->check_out->format('d/m/Y') }}</td></tr>
        <tr><td class="label">Noches</td><td class="value">{{ $booking->nights }}</td></tr>
        <tr><td class="label">Huéspedes</td><td class="value">{{ $booking->guests }}</td></tr>
        <tr><td class="label">Nombre</td><td class="value">{{ $booking->guest_name }}</td></tr>
        <tr><td class="label">Teléfono</td><td class="value">{{ $booking->guest_phone }}</td></tr>
        <tr><td class="label">Email</td><td class="value">{{ $booking->guest_email ?? '—' }}</td></tr>
        <tr><td class="label">Método de pago</td><td class="value">{{ $booking->payment_method?->label() }}</td></tr>
        <tr><td class="label" style="font-size:16px">Total</td><td class="total">{{ $booking->formatted_total }}</td></tr>
        <tr><td class="label">Depósito ({{ config('solstay.booking.deposit_percent') }}%)</td><td class="value" style="color:#f59e0b">{{ $booking->formatted_deposit }}</td></tr>
    </table>

    <div style="margin-top:30px;padding:15px;background:#f0fdfa;border-radius:8px;border:1px solid #0d9488">
        <p style="margin:0;color:#0d9488;font-weight:600">Datos de pago por transferencia:</p>
        <p style="margin:5px 0 0 0;">IBAN: {{ config('solstay.payment.transfer.iban') }}<br>
        Beneficiario: {{ config('solstay.payment.transfer.beneficiary') }}<br>
        Concepto: RESERVA-{{ $booking->id }}</p>
    </div>

    <p style="margin-top:30px;text-align:center;color:#888;font-size:12px">
        {{ config('solstay.business.email') }} · {{ config('solstay.business.phone') }}<br>
        Generado el {{ now()->format('d/m/Y H:i') }}
    </p>
</body>
</html>
