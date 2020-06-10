<?php

namespace Microboard\Http\Controllers;

use Illuminate\Auth\Access\AuthorizationException;
use Microboard\Http\Requests\UpdateUserFormRequest;
use Microboard\Http\Requests\StoreUserFormRequest;
use Microboard\DataTables\UserDataTable;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Exception;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param UserDataTable $table
     * @return Response
     * @throws AuthorizationException
     */
    public function index(UserDataTable $table)
    {
        $this->authorize('viewAny', new User);
        return $table->render('microboard::resource.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     * @throws AuthorizationException
     */
    public function create()
    {
        $this->authorize('create', new User);
        return view('microboard::resource.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUserFormRequest $request
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function store(StoreUserFormRequest $request)
    {
        $this->authorize('create', new User);
        $user = User::create($request->validated());
        return redirect()->route('microboard.users.show', $user);
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return View
     * @throws AuthorizationException
     */
    public function show(User $user)
    {
        $this->authorize('view', $user);
        return view('microboard::resource.view', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return View
     * @throws AuthorizationException
     */
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('microboard::resource.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateUserFormRequest $request
     * @param User $user
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(UpdateUserFormRequest $request, User $user)
    {
        $this->authorize('update', $user);
        $user->update($request->validated());
        return redirect()->route('microboard.users.show', $user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     * @throws AuthorizationException
     * @throws Exception
     */
    public function destroy(User $user)
    {
        $this->authorize('update', $user);
        $user->delete();
        return redirect()->route('microboard.users.index');
    }
}
