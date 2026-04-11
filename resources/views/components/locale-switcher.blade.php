<div class="flex items-center gap-1">
    @foreach(['es', 'en'] as $locale)
        <form method="POST" action="{{ route('locale.switch', $locale) }}" class="inline">
            @csrf
            <button type="submit"
                    style="padding: 4px 10px; border-radius: 6px; border: none; font-size: 12px; font-weight: 600; cursor: pointer; text-transform: uppercase; transition: all 0.2s;
                    {{ app()->getLocale() === $locale ? 'background: rgba(27,139,140,0.1); color: var(--color-primary);' : 'background: transparent; color: var(--color-text-light);' }}">
                {{ $locale }}
            </button>
        </form>
    @endforeach
</div>
