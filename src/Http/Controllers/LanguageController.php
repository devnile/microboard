<?php

namespace Microboard\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @param $code
     * @return RedirectResponse
     */
    public function __invoke(Request $request, $code)
    {
        if (in_array($code, collect(config('microboard.localizations', []))->pluck('code')->all())) {
            app()->setLocale($code);
            session()->put('locale', $code);
        }

        return redirect()->back();
    }
}
