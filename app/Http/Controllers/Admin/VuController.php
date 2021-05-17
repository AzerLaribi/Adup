<?php

namespace App\Http\Controllers\Admin;

use App\Vu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Consumer;
use App\Ad;
class VuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        $roleuser=$user->roles->first()->title;
        if($roleuser=='advertiser'){
            //$vus = Vu::where('ad_id','');
            
            
        }
        $vus = Vu::all();
       
        return view('admin.vu.index', compact('vus','roleuser'));
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
        $ads = Ad::all()->pluck('title', 'id');
        $user = \Auth::user();
        $roleuser=$user->roles->first()->title;
        return view('admin.vu.create',compact('consumores','ads','roleuser') );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vu = Vu::create($request->all());
      
        return redirect()->route('admin.vus.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Vu  $vu
     * @return \Illuminate\Http\Response
     */
    public function show(Vu $vu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Vu  $vu
     * @return \Illuminate\Http\Response
     */
    public function edit(Vu $vu)
    {
        $consumores = Consumer::all()->pluck('Mac', 'id');
        $ads = Ad::all()->pluck('title', 'id');
        $user = \Auth::user();
        $roleuser=$user->roles->first()->title;
        return view('admin.vu.edit',compact('vu','consumores','ads','roleuser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Vu  $vu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vu $vu)
    {
        $vu->update($request->all());
        return redirect()->route('admin.vus.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Vu  $vu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vu $vu)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vu->delete();

        return back();
    }
}
