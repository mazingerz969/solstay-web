<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index()
    {
        $properties = Property::withCount('bookings', 'photos')->get();

        return view('admin.properties.index', compact('properties'));
    }

    public function create()
    {
        return view('admin.properties.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|string|max:50|unique:properties',
            'name_es' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_es' => 'required|string',
            'description_en' => 'required|string',
            'address' => 'required|string|max:255',
            'price_per_night' => 'required|integer|min:100',
            'min_nights' => 'required|integer|min:1',
            'max_guests' => 'required|integer|min:1',
            'amenities_es' => 'nullable|string',
            'amenities_en' => 'nullable|string',
        ]);

        $validated['amenities_es'] = array_filter(array_map('trim', explode(',', $validated['amenities_es'] ?? '')));
        $validated['amenities_en'] = array_filter(array_map('trim', explode(',', $validated['amenities_en'] ?? '')));

        Property::create($validated);

        return redirect()->route('admin.properties.index')->with('success', 'Propiedad creada.');
    }

    public function edit(Property $property)
    {
        return view('admin.properties.edit', compact('property'));
    }

    public function update(Request $request, Property $property)
    {
        $validated = $request->validate([
            'name_es' => 'required|string|max:255',
            'name_en' => 'required|string|max:255',
            'description_es' => 'required|string',
            'description_en' => 'required|string',
            'address' => 'required|string|max:255',
            'price_per_night' => 'required|integer|min:100',
            'min_nights' => 'required|integer|min:1',
            'max_guests' => 'required|integer|min:1',
            'amenities_es' => 'nullable|string',
            'amenities_en' => 'nullable|string',
            'active' => 'boolean',
        ]);

        $validated['amenities_es'] = array_filter(array_map('trim', explode(',', $validated['amenities_es'] ?? '')));
        $validated['amenities_en'] = array_filter(array_map('trim', explode(',', $validated['amenities_en'] ?? '')));
        $validated['active'] = $request->boolean('active');

        $property->update($validated);

        return redirect()->route('admin.properties.index')->with('success', 'Propiedad actualizada.');
    }

    public function destroy(Property $property)
    {
        if ($property->bookings()->active()->exists()) {
            return back()->withErrors(['property' => 'No se puede eliminar una propiedad con reservas activas.']);
        }

        $property->delete();

        return redirect()->route('admin.properties.index')->with('success', 'Propiedad eliminada.');
    }
}
