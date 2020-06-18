<?php

namespace Microboard\Http\Controllers;

use Illuminate\Auth\Access\AuthorizationException;
use Microboard\Http\Requests\User\UpdateFormRequest;
use Microboard\Http\Requests\User\StoreFormRequest;
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
        return $table->render('microboard::users.index');
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
        return view('microboard::users.create');
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
        $this->authorize('create', new User);
        $user = User::create($request->validated());

        addMediaTo($user, 'avatar');

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
        return view('microboard::users.view', compact('user'));
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
        return view('microboard::users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateFormRequest $request
     * @param User $user
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function update(UpdateFormRequest $request, User $user)
    {
        $this->authorize('update', $user);
        $data = $request->only(['name', 'email', 'role_id']);

        if ($request->has('password') && $password = $request->get('password')) {
            $data['password'] = $password;
        }

        $user->update($data);

        addMediaTo($user, 'avatar');

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
