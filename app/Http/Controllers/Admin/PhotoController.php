<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use App\Models\PropertyPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function store(Request $request, Property $property)
    {
        $request->validate([
            'photo' => 'required|image|max:5120|mimes:jpg,jpeg,png,webp',
            'caption_es' => 'nullable|string|max:255',
            'caption_en' => 'nullable|string|max:255',
        ]);

        $path = $request->file('photo')->store('properties/' . $property->id, 'public');
        $maxOrder = $property->photos()->max('sort_order') ?? 0;

        $property->photos()->create([
            'path' => $path,
            'caption_es' => $request->caption_es,
            'caption_en' => $request->caption_en,
            'sort_order' => $maxOrder + 1,
        ]);

        return back()->with('success', 'Foto subida.');
    }

    public function destroy(PropertyPhoto $photo)
    {
        Storage::disk('public')->delete($photo->path);
        $photo->delete();

        return back()->with('success', 'Foto eliminada.');
    }
}
