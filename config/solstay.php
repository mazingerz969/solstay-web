<?php

return [
    'business' => [
        'name' => 'SolStay',
        'description_es' => 'Alojamientos vacacionales en la costa y la sierra. Reserva directo, sin comisiones.',
        'description_en' => 'Holiday rentals on the coast and in the mountains. Book direct, no commissions.',
        'phone' => '+34 612 345 678',
        'email' => 'reservas@solstay.es',
        'currency' => 'EUR',
        'currency_symbol' => '€',
        'timezone' => 'Europe/Madrid',
    ],

    'booking' => [
        'min_advance_days' => 1,
        'max_advance_months' => 12,
        'cancellation_hours' => 48,
        'deposit_percent' => 30,
        'payment_methods' => ['transfer', 'bizum'],
    ],

    'payment' => [
        'transfer' => [
            'bank' => 'CaixaBank',
            'iban' => 'ES12 3456 7890 1234 5678 9012',
            'beneficiary' => 'SolStay Alojamientos S.L.',
            'concept_prefix' => 'RESERVA',
        ],
        'bizum_phone' => '+34 612 345 678',
    ],
];
