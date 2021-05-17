<?php

/**
*this controller use to manipulate permission by admin
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyPermissionRequest;
use App\Http\Requests\StorePermissionRequest;
use App\Http\Requests\UpdatePermissionRequest;
use App\Permission;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PermissionsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('permission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = \Auth::user();
        $roleuser=$user->roles->first()->title;
        $permissions = Permission::all();

        return view('admin.permissions.index', compact('permissions','roleuser'));
    }

    public function create()
    {
        abort_if(Gate::denies('permission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = \Auth::user();
        $roleuser=$user->roles->first()->title;
        return view('admin.permissions.create','roleuser');
    }

    public function store(StorePermissionRequest $request)
    {
        $permission = Permission::create($request->all());
        $user = \Auth::user();
        $roleuser=$user->roles->first()->title;
        return redirect()->route('admin.permissions.index');
    }

    public function edit(Permission $permission)
    {
        abort_if(Gate::denies('permission_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = \Auth::user();
        $roleuser=$user->roles->first()->title;

        return view('admin.permissions.edit', compact('permission','roleuser'));
    }

    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        $permission->update($request->all());
        $user = \Auth::user();
        $roleuser=$user->roles->first()->title;

        return redirect()->route('admin.permissions.index');
    }

    public function show(Permission $permission)
    {
        abort_if(Gate::denies('permission_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = \Auth::user();
        $roleuser=$user->roles->first()->title;

        return view('admin.permissions.show', compact('permission','roleuser'));
    }

    public function destroy(Permission $permission)
    {
        abort_if(Gate::denies('permission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = \Auth::user();
        $roleuser=$user->roles->first()->title;

        $permission->delete();

        return back();
    }

    public function massDestroy(MassDestroyPermissionRequest $request)
    {
        Permission::whereIn('id', request('ids'))->delete();
        $user = \Auth::user();
        $roleuser=$user->roles->first()->title;

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
