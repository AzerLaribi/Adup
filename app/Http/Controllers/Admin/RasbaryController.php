<?php

/**
*this controller use to manipulate Rasbary
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Gate;

use App\Rasbary;
use App\Consumer;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
class RasbaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = \Auth::user();
        $roleuser=$user->roles->first()->title;
        $rasbarys = Rasbary::all();
        return view('admin.rasbary.index', compact('rasbarys','roleuser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = \Auth::user();
        $roleuser=$user->roles->first()->title;
        $consumers = Consumer::all()->pluck('Mac', 'id');

        return view('admin.rasbary.create',compact('consumers','roleuser') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rasbary = Rasbary::create($request->all());
        $rasbary->consumers()->sync($request->input('consumers', []));
        return redirect()->route('admin.rasbarys.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Rasbary  $rasbary
     * @return \Illuminate\Http\Response
     */
    public function show(Rasbary $rasbary)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = \Auth::user();
        $roleuser=$user->roles->first()->title;

        $consumers = Consumer::all()->pluck('Mac', 'id');
        $rasbary->load('consumers');

        return view('admin.rasbary.show', compact('rasbary','roleuser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Rasbary  $rasbary
     * @return \Illuminate\Http\Response
     */
    public function edit(Rasbary $rasbary)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $consumers = Consumer::all()->pluck('Mac', 'id');
        $rasbary->load('consumers');

        $user = \Auth::user();
        $roleuser=$user->roles->first()->title;

        return view('admin.rasbary.edit',compact('rasbary','consumers','roleuser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Rasbary  $rasbary
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Rasbary $rasbary)
    {
        $rasbary->update($request->all());

        $rasbary->consumers()->sync($request->input('consumers', []));

        return redirect()->route('admin.rasbarys.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Rasbary  $rasbary
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rasbary $rasbary)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rasbary->delete();

        return back();
    }
}
