<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function landing()
    {
        $properties = Property::active()->with('photos', 'reviews')->get();

        return view('pages.landing', compact('properties'));
    }

    public function index()
    {
        $properties = Property::active()->with('photos', 'reviews')->get();

        return view('pages.properties.index', compact('properties'));
    }

    public function show(Property $property)
    {
        $property->load('photos', 'reviews.user');

        return view('pages.properties.show', compact('property'));
    }
}
