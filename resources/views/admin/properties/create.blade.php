<x-guest-public title="Admin — Nueva Propiedad">
<section style="padding: 40px 24px 80px;">
    <div class="max-w-3xl mx-auto">
        <a href="{{ route('admin.properties.index') }}" style="color: #a1a1aa; text-decoration: none; font-size: 14px; margin-bottom: 24px; display: inline-block;">← Volver</a>
        <h1 style="font-size: 28px; font-weight: 800; color: #fafafa; margin: 0 0 32px 0;">Nueva Propiedad</h1>

        <form method="POST" action="{{ route('admin.properties.store') }}">
            @csrf
            @include('admin.properties._form')
            <button type="submit" style="margin-top: 24px; padding: 14px 32px; border-radius: 10px; border: none; background: #0d9488; color: white; font-size: 16px; font-weight: 600; cursor: pointer;">Crear Propiedad</button>
        </form>
    </div>
</section>
</x-guest-public>
