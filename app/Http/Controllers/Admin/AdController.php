<?php

/** Ads Manipulation (fetch ads data, delet, create) */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Gate;

use App\Ad;
use App\Venue;
use Illuminate\Support\Facades\DB;
use App\tag;
use App\typ;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdController extends Controller
{
    /**
     * Ads Table
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // ------------------------------------------Show Ads Table---------------------------------------------
    public function index()
    {


        $user = \Auth::user();
        $roleuser=$user->roles->first()->title;
        if($roleuser=='advertiser'){

            $ads = DB::table('ads')
            ->where('ads.user_id', $user->id)
            ->get();
            return view('admin.ads.index', compact('ads','roleuser'));
        }
        if($roleuser=='locationOwner'){


            return view('admin.ads.index', compact('ads','roleuser'));
        }
        $ads = Ad::all();

        return view('admin.ads.index', compact('ads','roleuser'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // -------------------------------------------------------------------------show Create Ads Page
    public function create()
    {
        $user = \Auth::user();
        $roleuser=$user->roles->first()->title;
        if($roleuser=='advertiser'){

            $venues=Venue::all()->pluck('name', 'id');
            $tags=tag::all()->pluck('name', 'id');
            $types=typ::all()->pluck('name', 'id');

            return view('admin.ads.create', compact('venues','roleuser','user','tags','types'));
        }
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $venues=Venue::all()->pluck('name', 'id');
        $tags=tag::all()->pluck('name', 'id');
        $types=typ::all()->pluck('name', 'id');

        return view('admin.ads.create', compact('venues','roleuser','user','tags','types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // -------------------------------------------Store function to create a new ads
    public function store(Request $request)
    {
        $user = \Auth::user();
        $ads = new Ad();
        $video = $request->file('video');
        $ads->owner = $request->input('owner');
        $ads->title = $request->input('title');
        $ads->description = $request->input('description');
        $ads->user_id = $request->input('user_id');
        $ads->owner = $request->input('owner');
        $ads->user_id = $request->input('user_id');
        $ads->type = $request->input('type');
        $ads->start = $request->input('start');
        $ads->end = $request->input('end');
        $ads->link = $request->input('link');
        $ads->priority = 1;
        $ads->video = $video;
        $destinationPath = 'Ads/Video/';
        $profileImage = $ads->title . "." . $video->getClientOriginalExtension();
        $video->move($destinationPath, $profileImage);
        $ads->video = $profileImage;
        $ads->save();
        $roleuser=$user->roles->first();
        $ads->venues()->sync($request->input('venues', []));
        return redirect()->route('admin.ads.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ads  $ads
     * @return \Illuminate\Http\Response
     */
    // -------------------------------------------Show information for each ads
    public function show(Ad $ad)
    {
       // abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user = \Auth::user();
        $roleuser=$user->roles->first()->title;

        $venues =  $ad->venues;

        $allCon = DB::table('consumers')
        ->join('ad_consumer', 'ad_consumer.consumer_id', '=', 'consumers.id')
        ->where('ad_consumer.ad_id', $ad->id)
        ->groupBy('consumer_id')
        ->get();

        $vuCount = DB::table('ad_consumer')->where('ad_id', $ad->id)->get()->count();
        $vus= DB::table('ad_consumer')->where('ad_id', $ad->id)->get();

        $locationCount = DB::table('ad_venue')
        ->join('venues', 'venues.id', '=', 'ad_venue.venue_id')
        ->where('ad_venue.ad_id', $ad->id)
        ->get()
        ->count();

        $males = DB::table('consumers')
        ->join('ad_consumer', 'ad_consumer.consumer_id', '=', 'consumers.id')
        ->where('consumers.sex', 'male')
        ->where('ad_consumer.ad_id', $ad->id)
        ->groupBy('consumer_id')
        ->get()
        ->count();

        $females = DB::table('consumers')
        ->join('ad_consumer', 'ad_consumer.consumer_id', '=', 'consumers.id')
        ->where('consumers.sex', 'female')
        ->where('ad_consumer.ad_id', $ad->id)
        ->groupBy('consumer_id')
        ->get()->count();


        $today=date('Y-m-d');
        $todayVus = DB::table('consumers')
        ->join('ad_consumer', 'ad_consumer.consumer_id', '=', 'consumers.id')
        ->whereDate('ad_consumer.created_at',$today)
        ->where('ad_consumer.ad_id', $ad->id)
        ->get()->count();
        $yesterday=date('Y-m-d', strtotime("-1 day"));
        $yesterdayVus = DB::table('consumers')
        ->join('ad_consumer', 'ad_consumer.consumer_id', '=', 'consumers.id')
        ->whereDate('ad_consumer.created_at',$yesterday)
        ->where('ad_consumer.ad_id', $ad->id)
        ->get()->count();

        $lastyesterday=date('Y-m-d', strtotime("-2 day"));
        $lastyesterdayVus = DB::table('consumers')
        ->join('ad_consumer', 'ad_consumer.consumer_id', '=', 'consumers.id')
        ->whereDate('ad_consumer.created_at',$lastyesterday)
        ->where('ad_consumer.ad_id', $ad->id)
        ->get()->count();

        $lastlastYesterday=date('Y-m-d', strtotime("-3 day"));
        $lastlastYesterdayVus = DB::table('consumers')
        ->join('ad_consumer', 'ad_consumer.consumer_id', '=', 'consumers.id')
        ->whereDate('ad_consumer.created_at',$lastlastYesterday)
        ->where('ad_consumer.ad_id', $ad->id)
        ->get()->count();

        $tomorow=date('Y-m-d', strtotime("+1 day"));
        $tomorowVus = DB::table('consumers')
        ->join('ad_consumer', 'ad_consumer.consumer_id', '=', 'consumers.id')
        ->whereDate('ad_consumer.created_at',$tomorow)
        ->where('ad_consumer.ad_id', $ad->id)
        ->get()->count();

        $aftertomorow=date('Y-m-d', strtotime("+2 day"));
        $aftertomorowVus = DB::table('consumers')
        ->join('ad_consumer', 'ad_consumer.consumer_id', '=', 'consumers.id')
        ->whereDate('ad_consumer.created_at',$aftertomorow)
        ->where('ad_consumer.ad_id', $ad->id)
        ->get()->count();

        $afteraftertomorow=date('Y-m-d', strtotime("+3 day"));
        $afteraftertomorowVus = DB::table('consumers')
        ->join('ad_consumer', 'ad_consumer.consumer_id', '=', 'consumers.id')
        ->whereDate('ad_consumer.created_at',$afteraftertomorow)
        ->where('ad_consumer.ad_id', $ad->id)
        ->get()->count();

        $youngs = DB::table('consumers')
        ->join('ad_consumer', 'ad_consumer.consumer_id', '=', 'consumers.id')
        ->where('consumers.age', '>=', 12)
        ->where('consumers.age', '<=', 16)
        ->where('ad_consumer.ad_id', $ad->id)
        ->groupBy('consumer_id')
        ->get()->count();
        $youngAdults = DB::table('consumers')
        ->join('ad_consumer', 'ad_consumer.consumer_id', '=', 'consumers.id')
        ->where('consumers.age', '>', 16)
        ->where('consumers.age', '<=', 18)
        ->where('ad_consumer.ad_id', $ad->id)
        ->groupBy('consumer_id')
        ->get()->count();
        $adults = DB::table('consumers')
        ->join('ad_consumer', 'ad_consumer.consumer_id', '=', 'consumers.id')
        ->where('ad_consumer.ad_id', $ad->id)
        ->where('consumers.age', '>', 18)
        ->where('consumers.age', '<=', 29)
        ->groupBy('consumer_id')
        ->get()->count();
        $middleAged = DB::table('consumers')
        ->join('ad_consumer', 'ad_consumer.consumer_id', '=', 'consumers.id')
        ->where('ad_consumer.ad_id', $ad->id)
        ->where('consumers.age', '>', 29)
        ->where('consumers.age', '<=', 60)
        ->groupBy('consumer_id')
        ->get()->count();
        $old = DB::table('consumers')
        ->join('ad_consumer', 'ad_consumer.consumer_id', '=', 'consumers.id')
        ->where('ad_consumer.ad_id', $ad->id)
        ->where('consumers.age', '>', 60)
        ->groupBy('consumer_id')
        ->get()->count();


        return view('admin.ads.show', compact('ad','roleuser','vuCount','vus','todayVus','yesterdayVus','lastlastYesterdayVus','lastyesterdayVus',
    'tomorowVus','aftertomorowVus','afteraftertomorowVus','males','females','youngs','youngAdults','adults','middleAged',
'old','locationCount','venues','allCon'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ads  $ads
     * @return \Illuminate\Http\Response
     */
    // -------------------------------------------edit ads
    public function edit(Ad $ad)
    {
        $user = \Auth::user();
        $roleuser=$user->roles->first()->title;
        $venues=Venue::all()->pluck('name', 'id');
        $ad->load('venues');
        return view('admin.ads.edit',compact('ad','venues','roleuser'));
    }

    public function adLocations($adid)
    {
        $ads = Ad::all();

        $user = \Auth::user();

        $roleuser=$user->roles->first()->title;

        $ad=Ad::where('id', $adid)->first();

        $venues =  $ad->venues;
        return view('admin.ads.adLocations', compact('venues','roleuser','ad'));
    }



    public function venueState($adid,$venueID)
    {


        $user = \Auth::user();

        $roleuser=$user->roles->first()->title;

        $venue =Venue::where('id', $venueID)->first();
        $ad=Ad::where('id', $adid)->first();
        $totalVus = DB::table('rasbary_venue')
           ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
           ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
           ->join('ad_consumer', 'ad_consumer.consumer_id', '=', 'consumers.id')
           ->where('ad_consumer.ad_id', $adid)
           ->where('rasbary_venue.venue_id', $venueID)
           ->get()
           ->count();

        $totalVusMale = DB::table('rasbary_venue')
           ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
           ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
           ->join('ad_consumer', 'ad_consumer.consumer_id', '=', 'consumers.id')

           ->where('ad_consumer.ad_id', $adid)
           ->where('consumers.sex', 'male')
           ->where('rasbary_venue.venue_id', $venueID)
           ->get()
           ->count();

        $totalVusFeMale = DB::table('rasbary_venue')
           ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
           ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
           ->join('ad_consumer', 'ad_consumer.consumer_id', '=', 'consumers.id')

           ->where('ad_consumer.ad_id', $adid)
           ->where('consumers.sex', 'female')
           ->where('rasbary_venue.venue_id', $venueID)
           ->get()
           ->count();

        $today=date('Y-m-d');
        $todayMale = DB::table('rasbary_venue')
         //   ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->whereDate('consumer_rasbary.created_at',$today)
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->join('ad_consumer', 'ad_consumer.consumer_id', '=', 'consumers.id')
            ->where('consumers.sex', 'male')
            ->where('ad_consumer.ad_id', $adid)
            ->where('rasbary_venue.venue_id', $venueID)
            ->get()
            ->count();



        return view('admin.ads.showssA', compact('venue','roleuser','totalVus','todayMale','totalVusMale','totalVusFeMale'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ad $ad)
    {
        $ad->update($request->all());
        $ad->venues()->sync($request->input('venues', []));

        return redirect()->route('admin.ads.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ads  $ads
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ad $ad)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $ad->delete();

        return back();
    }
    public function validation($id)
    {
        $ad = Ad::findOrFail($id);
        if ($ad->status == 0) {
            $ad->status = 1;
            $ad->save();

        }
        return redirect()->route('admin.ads.index');
    }
}
