<?php

namespace Microboard\Traits;

use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Microboard\Foundations\Traits\DependencyResolverTrait;
use Microboard\Foundations\Traits\QueryResolverTrait;
use Microboard\Foundations\Traits\ViewResolverTrait;
use Microboard\Foundations\Traits\WorkingWithWidgets;
use Throwable;

trait Controller
{
    use DependencyResolverTrait,
        QueryResolverTrait,
        WorkingWithWidgets,
        ViewResolverTrait;

    /**
     * @var string
     */
    protected string $baseName;

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        $this->baseName = str_replace('Controller', '', class_basename($this));
        $this->model = $this->getModel() ? resolve($this->getModel()) : null;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', $this->model);
        $datatable = resolve($this->getDatatable(), [
            'attributes' => $this->attributes ?? []
        ]);

        return $datatable->render($this->getViewPathFor('index'), $this->getResourceVariables('index'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        $this->authorize('create', $this->model);
        return view($this->getViewPathFor('create'), $this->getResourceVariables('create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return RedirectResponse
     * @throws Throwable
     */
    public function store()
    {
        $request = resolve($this->getStoreFormRequest());
        $variables = $this->getResourceVariables('create');
        $this->authorize('create', $this->model);

        $model = $this->model->fill($this->getValidated($request));
        $this->model->saveOrFail();
        cache()->forget($variables['resourceName']);

        if ($response = $this->created($request, $model)) {
            return $response;
        }

        return redirect()->route("{$variables['routePrefix']}.show", $model);
    }

    /**
     * The model has been created.
     *
     * @param Request $request
     * @param Model $model
     * @return mixed
     */
    protected function created($request, $model)
    {
        //
    }

    /**
     * Display the specified resource.
     * @param Request $request
     * @return View
     */
    public function show(Request $request)
    {
        $model = $this->query($request);
        $this->authorize('view', $model);

        return view($this->getViewPathFor('show'), $this->getResourceVariables('show', $model));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @return View
     */
    public function edit(Request $request)
    {
        $model = $this->query($request);
        $this->authorize('update', $model);

        return view($this->getViewPathFor('edit'), $this->getResourceVariables('update', $model));
    }

    /**
     * Update the specified resource in storage.
     *
     * @throws Exception
     */
    public function update()
    {
        $request = resolve($this->getUpdateFormRequest());
        $model = $this->query($request);
        $this->authorize('update', $model);
        $variables = $this->getResourceVariables('update');

        $model->update($this->getValidated($request));
        cache()->forget($variables['resourceName']);

        if ($response = $this->updated($request, $model)) {
            return $response;
        }

        return redirect()->route("{$variables['routePrefix']}.show", $model);
    }

    /**
     * The model has been updated.
     *
     * @param Request $request
     * @param Model $model
     * @return mixed
     */
    protected function updated($request, $model)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws Exception
     */
    public function destroy(Request $request)
    {
        $variables = $this->getResourceVariables('delete');
        $model = $this->query($request);
        $this->authorize('update', $model);

        $model->delete();
        cache()->forget($variables['resourceName']);

        if ($response = $this->deleted($request, $model)) {
            return $response;
        }

        return redirect()->route("{$variables['routePrefix']}.index");
    }

    /**
     * The model has been updated.
     *
     * @param Request $request
     * @param Model $model
     * @return mixed
     */
    protected function deleted($request, $model)
    {
        //
    }
}
