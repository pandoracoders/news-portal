<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\UserRequest;
use App\Models\Backend\Role;
use App\Models\Backend\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $path = 'backend.pages.user.';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view($this->path . 'index', [
            'users' => User::orderBy('id', 'desc')->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->path . 'crud', [
            'permissions' => RoleController::getRouteArray(),
            'roles' => Role::orderBy('id', 'desc')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = User::create(array_filter($request->validated()));
        $user->permission()->updateOrCreate(['role_id' => $request->role_id], ['permissions' => $request->permissions]);
        return redirect()
            ->route('backend.user-view')
            ->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view($this->path . 'crud', [
            'user' => $user,
            'permissions' => RoleController::getRouteArray(),
            'roles' => Role::orderBy('id', 'desc')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {

        $user->update(array_filter($request->validated()));
        $user->permission()->updateOrCreate(['user_id' => $user->id], ['role_id' => $request->role_id, 'permissions' => $request->permissions]);
        return redirect()
            ->route('backend.user-view')
            ->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user?->delete();
        return redirect()
            ->route('backend.user-view')
            ->with('success', 'User deleted successfully.');
    }
}
