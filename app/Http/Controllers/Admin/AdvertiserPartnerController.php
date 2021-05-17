<?php
/**
*this controller use to manipulate ads partner by advertiser
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Ads;
use App\User;
use App\Location;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;


class AdvertiserPartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        $ads = Ads::all();
        $roleuser=$user->role->first();
        if($roleuser=='advertiser'){

            $ads = DB::table('ads')
            ->where('ads.user_id', $user->id)
            ->get();
            return view('Advertiser.index', compact('ads','roleuser'));
        }
        return view('Advertiser.index', compact('ads','roleuser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function createVideo()
    {
        $user = \Auth::user();
        $roleuser=$user->roles->first();
        if($roleuser=='advertiser'){
            $venues=Location::all();
            return view('Advertiser.createVideo', compact('venues','roleuser','user'));
        }
        // $venues = DB::table('locations')
        //             ->groupBy('name')
        //             ->get();
        $venues=Location::all();

        return view('Advertiser.createVideo', compact('venues','roleuser','user'));
    }
    public function createImage()
    {
        $user = \Auth::user();
        $roleuser=$user->roles->first();
        if($roleuser=='advertiser'){

            $venues=Location::all();

            return view('Advertiser.createImage', compact('venues','roleuser','user'));
        }
        $venues=Location::all();

        return view('Advertiser.createImage', compact('venues','roleuser','user'));
    }
    public function storeVideo(Request $request)
    {
        $user = \Auth::user();
        $venues=Location::all();
        $ads = new Ads();
        $video = $request->file('video');
        $ads->owner = $request->input('owner');
        // $fileName = uniqid($locationpartes->location_name) . '.' . $file->getClientOriginalExtension();
        $ads->title = $request->input('title');
        $ads->description = $request->input('description');
        $ads->user_id = $request->input('user_id');
        $ads->owner = $request->input('owner');
        $ads->user_id = $request->input('user_id');
        $ads->type = $request->input('type');
        $ads->start = $request->input('start');
        $ads->end = $request->input('end');
        $ads->link = $request->input('link');
        $ads->location_id = $request->input('location_id');
        $ads->priority = 1;
        $ads->video = $video;
        $destinationPath = 'Ads/Video/';
        $profileImage = $ads->title . "." . $video->getClientOriginalExtension();
        $video->move($destinationPath, $profileImage);
        $ads->video = $profileImage;
        $ads->save();
        $roleuser=$user->roles->first();
        return view('Advertiser.createVideo', compact('user','roleuser','venues'));
    }
    public function storeImage(Request $request)
    {
        $user = \Auth::user();
        $venues=Location::all();
        $ads = Ads::create($request->all());
        $roleuser=$user->roles->first();
        return view('Advertiser.createImage', compact('user','roleuser','venues'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ads $ad)
    {

        return view('Advertiser.show', compact('ad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
