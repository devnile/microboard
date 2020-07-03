<?php

namespace Microboard\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return View
     */
    public function __invoke(Request $request)
    {
        return view('microboard::index', [
            'widgets' => resolve('App\\Providers\\MicroboardServiceProvider', [
                'app' => app()
            ])->widgets()
        ]);
    }
}
