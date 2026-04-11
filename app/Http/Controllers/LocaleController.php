<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocaleController extends Controller
{
    public function switch(string $locale)
    {
        if (! in_array($locale, ['es', 'en'])) {
            abort(400);
        }

        if (auth()->check()) {
            auth()->user()->update(['locale' => $locale]);
        }

        return back()->withCookie(cookie('locale', $locale, 60 * 24 * 365));
    }
}
