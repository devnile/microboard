<?php

namespace Microboard\Http\Controllers;

use Illuminate\Auth\Access\AuthorizationException;
use Microboard\Http\Requests\Role\UpdateFormRequest;
use Microboard\Http\Requests\Role\StoreFormRequest;
use Microboard\DataTables\RoleDataTable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Exception;
use Microboard\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param RoleDataTable $table
     * @return Response
     * @throws AuthorizationException
     */
    public function index(RoleDataTable $table)
    {
        $this->authorize('viewAny', new Role);
        return $table->render('microboard::roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', new Role);
        return view('microboard::roles.create');
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
        $this->authorize('create', new Role);
        $role = Role::create($request->only(['name', 'display_name']));
        $role->permissions()->attach($request->get('permissions'));
        return redirect()->route('microboard.roles.show', $role);
    }

    /**
     * Display the specified resource.
     *
     * @param Role $role
     * @return View
     * @throws AuthorizationException
     */
    public function show(Role $role)
    {
        $this->authorize('view', $role);
        return view('microboard::roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @return View
     * @throws AuthorizationException
     */
    public function edit(Role $role)
    {
        $this->authorize('update', $role);
        return view('microboard::roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateFormRequest $request
     * @param Role $role
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(UpdateFormRequest $request, Role $role)
    {
        $this->authorize('update', $role);
        $role->update($request->only(['name', 'display_name']));
        $role->permissions()->sync($request->get('permissions'));
        return redirect()->route('microboard.roles.show', $role);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Role $role
     * @return RedirectResponse
     * @throws AuthorizationException
     * @throws Exception
     */
    public function destroy(Role $role)
    {
        $this->authorize('update', $role);
        $role->delete();
        return redirect()->route('microboard.roles.index');
    }
}
