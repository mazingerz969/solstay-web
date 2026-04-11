<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlockedDate;
use App\Models\Property;
use Illuminate\Http\Request;

class BlockedDateController extends Controller
{
    public function index()
    {
        $properties = Property::all();
        $blockedDates = BlockedDate::with('property')->latest()->get();

        return view('admin.blocked-dates.index', compact('properties', 'blockedDates'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'property_id' => 'required|exists:properties,id',
            'date_from' => 'required|date|after:today',
            'date_to' => 'required|date|after:date_from',
            'reason' => 'nullable|string|max:255',
        ]);

        BlockedDate::create($validated);

        return back()->with('success', 'Fechas bloqueadas.');
    }

    public function destroy(BlockedDate $blockedDate)
    {
        $blockedDate->delete();

        return back()->with('success', 'Bloqueo eliminado.');
    }
}
