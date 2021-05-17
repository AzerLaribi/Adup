<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Role;
use App\User;
use App\Venue;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $usera = \Auth::user();
        $roleuser=$usera->roles->first()->title;
        $users = User::all();

        return view('admin.users.index', compact('users','roleuser'));
    }

    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::all()->pluck('title', 'id');
        $venues = Venue::all()->pluck('name', 'id');
        $usera = \Auth::user();
        $roleuser=$usera->roles->first()->title;
        return view('admin.users.create', compact('roles','venues','roleuser'));
    }

    public function store(StoreUserRequest $request)
    {
        $user = User::create($request->all());
        $user->roles()->sync($request->input('roles', []));
        $user->venues()->sync($request->input('venues', []));

        return redirect()->route('admin.users.index');
    }

    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $usera = \Auth::user();
        $roleuser=$usera->roles->first()->title;
        $roles = Role::all()->pluck('title', 'id');
        $venues = Venue::all()->pluck('name', 'id');

        $user->load('roles');

        $user->load('venues');

        return view('admin.users.edit', compact('roles', 'user','venues','roleuser'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->all());
        $user->roles()->sync($request->input('roles', []));
        $user->venues()->sync($request->input('venues', []));

        return redirect()->route('admin.users.index');
    }

    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $usera = \Auth::user();
        $roleuser=$usera->roles->first()->title;
        $user->load('roles');
        $user->load('venues');

        return view('admin.users.show', compact('user','roleuser'));
    }

    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
