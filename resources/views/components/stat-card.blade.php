@props(['value', 'label', 'icon' => '📊'])

<div style="background: white; border-radius: 12px; padding: 24px; box-shadow: var(--shadow-sm); border: 1px solid var(--color-border);">
    <div class="flex items-center justify-between" style="margin-bottom: 12px;">
        <span style="font-size: 24px;">{{ $icon }}</span>
    </div>
    <div style="font-family: 'Poppins', sans-serif; font-size: 28px; font-weight: 700; color: var(--color-text); margin-bottom: 4px;">{{ $value }}</div>
    <div style="font-size: 13px; color: var(--color-text-secondary); font-weight: 500;">{{ $label }}</div>
</div>
