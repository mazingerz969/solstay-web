<?php

namespace App\Enums;

enum PaymentMethod: string
{
    case Transfer = 'transfer';
    case Bizum = 'bizum';

    public function label(string $locale = 'es'): string
    {
        return match ($this) {
            self::Transfer => $locale === 'es' ? 'Transferencia bancaria' : 'Bank transfer',
            self::Bizum => 'Bizum',
        };
    }
}
