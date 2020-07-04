<?php

namespace Microboard\Http\Controllers;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Microboard\Http\Requests\Setting\StoreFormRequest;
use Microboard\Http\Requests\Setting\UpdateFormRequest;
use Microboard\Models\Setting;

class SettingController extends ResourceController
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
        return view('microboard::settings.index', [
            'settings' => cache()->remember('settings', 25000, function () {
                return Setting::all();
            })
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateFormRequest $request
     * @param Setting $setting
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update()
    {
        $request = resolve($this->getUpdateFormRequest());
        $this->authorize('update', new Setting);

        foreach ($request->get('value') as $id => $value) {
            $setting = tap(Setting::find($id))->update(compact('value'));

            if (in_array($setting->type, ['avatar', 'files'])) {
                if ($setting->type === 'avatar') {
                    $setting->getMedia()->each->delete();
                }

                addMediaTo($setting, 'default', "value.{$setting->id}");
            }
        }

        cache()->forget('settings');

        return redirect()->back();
    }

    /**
     * @return string
     */
    protected function getUpdateFormRequest(): string
    {
        return UpdateFormRequest::class;
    }

    /**
     * @param StoreFormRequest $request
     * @param Setting $model
     * @return RedirectResponse
     */
    protected function created($request, $model)
    {
        addMediaTo($model, 'default', "value.{$model->id}");

        return redirect()->back();
    }

    /**
     * @return string
     */
    protected function getModel(): string
    {
        return Setting::class;
    }

    /**
     * @return string
     */
    protected function getStoreFormRequest(): string
    {
        return StoreFormRequest::class;
    }
}
