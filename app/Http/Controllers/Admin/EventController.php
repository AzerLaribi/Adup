<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Gate;

use App\Ad;
use App\Venue;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Event;

class EventController extends Controller
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
        if($roleuser=='advertiser' || $roleuser =='Admin' ){
            $events = Event::all();
            return view('admin.event.index', compact('roleuser','user','events'));
        }
        if($roleuser=='locationOwner'){
            //$events = Event::where('user_id', $user->id);
            //$events = Event::all();
            $events = DB::table('events')
            ->where('user_id', '=', $user->id)
            ->get() ;
            return view('admin.event.index', compact('roleuser','user','events'));
        }
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = \Auth::user();
        $roleuser=$user->roles->first()->title;
        return view('admin.event.create',compact('roleuser','user'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = Event::create($request->all());

        return redirect()->route('admin.events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        $user = \Auth::user();
        $roleuser=$user->roles->first()->title;
        return view('admin.event.show', compact('event','roleuser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $user = \Auth::user();
        $roleuser=$user->roles->first()->title;

        return view('admin.event.edit', compact('event','roleuser','user'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $event->update($request->all());

        return redirect()->route('admin.events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return back();
    }
}
