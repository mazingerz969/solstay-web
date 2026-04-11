<x-guest-public title="Admin — Editar {{ $property->name_es }}">
<section style="padding: 40px 24px 80px;">
    <div class="max-w-3xl mx-auto">
        <a href="{{ route('admin.properties.index') }}" style="color: #a1a1aa; text-decoration: none; font-size: 14px; margin-bottom: 24px; display: inline-block;">← Volver</a>
        <h1 style="font-size: 28px; font-weight: 800; color: #fafafa; margin: 0 0 32px 0;">Editar: {{ $property->name_es }}</h1>

        @if(session('success'))
            <div style="background: rgba(34,197,94,0.1); border: 1px solid rgba(34,197,94,0.3); border-radius: 12px; padding: 16px; margin-bottom: 24px;">
                <p style="color: #22c55e; font-size: 14px; margin: 0;">{{ session('success') }}</p>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.properties.update', $property) }}">
            @csrf @method('PUT')
            @include('admin.properties._form', ['property' => $property])
            <div class="flex items-center gap-3" style="margin-top: 24px;">
                <button type="submit" style="padding: 14px 32px; border-radius: 10px; border: none; background: #0d9488; color: white; font-size: 16px; font-weight: 600; cursor: pointer;">Guardar Cambios</button>
            </div>
        </form>

        {{-- Photos section --}}
        <div style="margin-top: 48px;">
            <h2 style="color: #fafafa; font-size: 20px; font-weight: 700; margin: 0 0 16px 0;">📸 Fotos</h2>

            @if($property->photos->count())
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4" style="margin-bottom: 24px;">
                    @foreach($property->photos as $photo)
                        <div style="position: relative; border-radius: 12px; overflow: hidden; background: #1a1a20; height: 160px;">
                            <img src="{{ $photo->url }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                            <form method="POST" action="{{ route('admin.photos.destroy', $photo) }}" style="position: absolute; top: 8px; right: 8px;">
                                @csrf @method('DELETE')
                                <button type="submit" style="background: rgba(239,68,68,0.8); border: none; color: white; width: 28px; height: 28px; border-radius: 50%; cursor: pointer; font-size: 14px;">✕</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('admin.properties.photos.store', $property) }}" enctype="multipart/form-data"
                  style="background: #141418; border-radius: 16px; border: 1px solid rgba(255,255,255,0.06); padding: 24px;">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label style="color: #a1a1aa; font-size: 13px; font-weight: 600; display: block; margin-bottom: 8px;">Foto</label>
                        <input type="file" name="photo" accept="image/*" required style="color: #a1a1aa; font-size: 14px;">
                    </div>
                    <div>
                        <label style="color: #a1a1aa; font-size: 13px; font-weight: 600; display: block; margin-bottom: 8px;">Caption (ES)</label>
                        <input type="text" name="caption_es" style="width: 100%; background: #1a1a20; border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; padding: 10px; color: #fafafa; font-size: 14px; outline: none;">
                    </div>
                </div>
                <button type="submit" style="margin-top: 16px; padding: 10px 20px; border-radius: 8px; border: none; background: #0d9488; color: white; font-size: 14px; font-weight: 600; cursor: pointer;">Subir Foto</button>
            </form>
        </div>
    </div>
</section>
</x-guest-public>
