<?php

namespace Microboard\Http\Controllers;

use Illuminate\Auth\Access\AuthorizationException;
use Microboard\Http\Requests\Setting\UpdateFormRequest;
use Microboard\Http\Requests\Setting\StoreFormRequest;
use Illuminate\Http\RedirectResponse;
use Microboard\Models\Setting;
use Illuminate\View\View;
use function GuzzleHttp\Promise\all;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     * @throws AuthorizationException
     */
    public function index()
    {
        $this->authorize('viewAny', new Setting);
        return view('microboard::settings.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreFormRequest $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function store(StoreFormRequest $request)
    {
        $this->authorize('create', new Setting);
        Setting::create($request->validated());
        return redirect()->route('microboard.settings.index');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateFormRequest $request
     * @param Setting $setting
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(UpdateFormRequest $request)
    {
        $this->authorize('update', new Setting);

        foreach ($request->get('value') as $id => $value) {
            Setting::find($id)->update(compact('value'));
        }

        addMediaTo(new Setting);

        return redirect()->route('microboard.settings.index');
    }
}
