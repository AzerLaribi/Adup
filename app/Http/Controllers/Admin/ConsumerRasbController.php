<?php

namespace App\Http\Controllers\Admin;

use App\Vu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Consumer;
use App\Rasbary;
use App\ConsumerRasb;

class ConsumerRasbController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $consumerRasbs = ConsumerRasb::all();
        $user = \Auth::user();
        $roleuser=$user->roles->first()->title;
        return view('admin.RasbCons.index', compact('consumerRasbs','roleuser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $consumores = Consumer::all()->pluck('Mac', 'id');
        $rasbarys = Rasbary::all()->pluck('key', 'id');
        $user = \Auth::user();
        $roleuser=$user->roles->first()->title;
        return view('admin.RasbCons.create',compact('consumores','rasbarys','roleuser') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $consumerRasb = ConsumerRasb::create($request->all());
      
        return redirect()->route('admin.rasbsconsumores.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ConsumerRasb  $consumerRasb
     * @return \Illuminate\Http\Response
     */
    public function show(ConsumerRasb $consumerRasb)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ConsumerRasb  $consumerRasb
     * @return \Illuminate\Http\Response
     */
    public function edit(ConsumerRasb $consumerRasb)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ConsumerRasb  $consumerRasb
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConsumerRasb $consumerRasb)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ConsumerRasb  $consumerRasb
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConsumerRasb $consumerRasb)
    {

        $consumerRasb->delete();

        return back();
    }
}
