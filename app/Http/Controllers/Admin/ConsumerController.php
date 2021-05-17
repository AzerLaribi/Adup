<?php


namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Gate;

use App\Consumer;
use App\Ad;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConsumerController extends Controller
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
        $consumors = Consumer::all();

        return view('admin.consumer.index', compact('consumors','roleuser'));
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
        $ads = Ad::all()->pluck('title', 'id');

        return view('admin.consumer.create', compact('ads','roleuser'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $consumer = Consumer::create($request->all());
        $consumer->ads()->sync($request->input('ads', []));
        return redirect()->route('admin.consumers.index');
    }

    public function storeMe(Request $request)
    {
        $consumer = Consumer::create($request->all());
        $consumer->ads()->sync($request->input('ads', []));
        return back();
    }
   

    /**
     * Display the specified resource.
     *
     * @param  \App\Consumer  $consumer
     * @return \Illuminate\Http\Response
     */
    public function show(Consumer $consumer)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = \Auth::user();
        $roleuser=$user->roles->first()->title;

        return view('admin.consumer.show', compact('consumer','roleuser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Consumer  $consumer
     * @return \Illuminate\Http\Response
     */
    public function edit(Consumer $consumer)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $ads = Ad::all()->pluck('title', 'id');
        $consumer->load('ads');
        $user = \Auth::user();
        $roleuser=$user->roles->first()->title;
        return view('admin.consumer.edit',compact('consumer','ads','roleuser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Consumer  $consumer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consumer $consumer)
    {
        $consumer->update($request->all());
        $consumer->ads()->sync($request->input('ads', []));
        error_log('sakka');
        error_log(print_r( $request->input('ads', [])));
     
        return redirect()->route('admin.consumers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Consumer  $consumer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consumer $consumer)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $consumer->delete();

        return back();
    }
}
