@props(['status'])

@php
$colors = [
    'pending' => ['bg' => '#FEF3C7', 'text' => '#92400E'],
    'confirmed' => ['bg' => '#D1FAE5', 'text' => '#065F46'],
    'checked_in' => ['bg' => '#DBEAFE', 'text' => '#1E40AF'],
    'completed' => ['bg' => '#D1FAE5', 'text' => '#065F46'],
    'cancelled' => ['bg' => '#FEE2E2', 'text' => '#991B1B'],
];
$c = $colors[$status->value] ?? ['bg' => '#F3F4F6', 'text' => '#374151'];
@endphp

<span style="display: inline-flex; align-items: center; gap: 4px; padding: 4px 10px; border-radius: 6px; font-size: 12px; font-weight: 600; background: {{ $c['bg'] }}; color: {{ $c['text'] }};">
    {{ $status->icon() }} {{ $status->label(app()->getLocale()) }}
</span>
