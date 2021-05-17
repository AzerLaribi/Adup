<?php
/**
*this controller use to manipulate locations
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyVenueRequest;
use App\Http\Requests\StoreVenueRequest;
use App\Http\Requests\UpdateVenueRequest;
use App\Venue;
use Gate;
use App\User;
use App\Rasbary;
use App\tag;
use App\typ;
use DB;


use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VenuesController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {

        $regions = ['Tunis','Sousse','Monastir'];
        $user = \Auth::user();
        $roleuser=$user->roles->first()->title;
        if($roleuser=='locationOwner'){
            $venues = $user->venues;
            return view('admin.venues.index', compact('venues','roleuser'));
        }
        //abort_if(Gate::denies('venue_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $venues = Venue::all();

        return view('admin.venues.index', compact('venues','roleuser','regions'));
    }

    public function create()
    {
        abort_if(Gate::denies('venue_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = \Auth::user();
        $roleuser=$user->roles->first()->title;
        $users = User::all()->pluck('name', 'id');
        $rasbarys=Rasbary::all()->pluck('key', 'id');
        $tags=tag::all()->pluck('name', 'id');
        $typs=typ::all()->pluck('name', 'id');
        $regions = ['Tunis','Sousse','Monastir'];

        return view('admin.venues.create',compact('users','rasbarys','tags','typs','roleuser','regions'));
    }

    public function store(StoreVenueRequest $request)
    {
        $venue = new Venue();
        $image = $request->file('logo');
        $venue->name = $request->input('name');
        $venue->address = $request->input('address');
        $venue->latitude = $request->input('latitude');
        $venue->region = $request->input('region');
        $venue->longitude = $request->input('longitude');
        $venue->status = 1;
        $venue->description = $request->input('description');
        $venue->logo = $image;
        $destinationPath = 'image/LocationPartner';
        $profileImage = $venue->name . "." . $image->getClientOriginalExtension();
        $image->move($destinationPath, $profileImage);
        $venue->logo = $profileImage;
        $venue->save();
        $venue->rasbarys()->sync($request->input('rasbarys', []));
        $venue->tags()->sync($request->input('tags', []));
        $venue->typs()->sync($request->input('typs', []));


        return redirect()->route('admin.venues.index');
    }

    public function edit(Venue $venue)
    {

        $user = \Auth::user();
        $roleuser=$user->roles->first()->title;
        if($roleuser=='locationOwner' ){
            $rasbarys=Rasbary::all()->pluck('key', 'id');
            $tags=tag::all()->pluck('name', 'id');
            $typs=typ::all()->pluck('name', 'id');
            $venue->load('rasbarys');
            $venue->load('tags');
            $venue->load('typs');
            $regions = ['Tunis','Sousse','Monastir'];


            return view('admin.venues.edit', compact('venue','rasbarys','tags','typs','roleuser','region'));
        }
        abort_if(Gate::denies('venue_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $rasbarys=Rasbary::all()->pluck('key', 'id');
        $tags=tag::all()->pluck('name', 'id');
        $typs=typ::all()->pluck('name', 'id');
        $regions = ['Tunis','Sousse','Monastir'];
        $venue->load('rasbarys');
        $venue->load('tags');
        $venue->load('typs');

        return view('admin.venues.edit', compact('venue','rasbarys','tags','typs','roleuser','regions'));
    }

    public function update(UpdateVenueRequest $request, Venue $venue)
    {
        $venue->update($request->all());
        $venue->rasbarys()->sync($request->input('rasbarys', []));
        $venue->tags()->sync($request->input('tags', []));
        $venue->typs()->sync($request->input('typs', []));
        return redirect()->route('admin.venues.index');
    }

    public function show(Venue $venue)
    {

        $user = \Auth::user();
        $roleuser=$user->roles->first()->title;

        $today=date('Y-m-d');
        $todayMale = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->whereDate('consumer_rasbary.created_at',$today)
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.sex', 'male')
            ->groupBy('consumer_id')
            ->get()
            ->count();
        $todayFeMale = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->whereDate('consumer_rasbary.created_at',$today)
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.sex', 'female')
            ->get()
            ->groupBy('consumer_id')
            ->count();
        //-1
        $yesterday=date('Y-m-d', strtotime("-1 day"));
        $yesterdayMale = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->whereDate('consumer_rasbary.created_at',$yesterday)
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.sex', 'male')
            ->groupBy('consumer_id')
            ->get()
            ->count();
         $yesterdayFeMale = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->whereDate('consumer_rasbary.created_at',$yesterday)
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.sex', 'female')
            ->groupBy('consumer_id')
            ->get()
            ->count();
        //-2
        $lastyesterday=date('Y-m-d', strtotime("-2 day"));
        $lastyesterdaydayMale = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->whereDate('consumer_rasbary.created_at',$lastyesterday)
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.sex', 'male')
            ->groupBy('consumer_id')
            ->get()
            ->count();
         $lastyesterdayFeMale = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->whereDate('consumer_rasbary.created_at',$lastyesterday)
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.sex', 'female')
            ->groupBy('consumer_id')
            ->get()
            ->count();
        //-3
        $lastlastYesterday=date('Y-m-d', strtotime("-3 day"));
        $lastlastYesterdayMale = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->whereDate('consumer_rasbary.created_at',$lastlastYesterday)
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.sex', 'male')
            ->groupBy('consumer_id')
            ->get()
            ->count();
         $lastlastYesterdayFeMale = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->whereDate('consumer_rasbary.created_at',$lastlastYesterday)
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.sex', 'female')
            ->groupBy('consumer_id')
            ->get()
            ->count();
        //+1
        $tomorow=date('Y-m-d', strtotime("+1 day"));
        $tomorowMale = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->whereDate('consumer_rasbary.created_at',$tomorow)
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.sex', 'male')
            ->groupBy('consumer_id')
            ->get()
            ->count();
         $tomorowFeMale = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->whereDate('consumer_rasbary.created_at',$tomorow)
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.sex', 'female')
            ->groupBy('consumer_id')
            ->get()
            ->count();
        //+2
        $aftertomorow=date('Y-m-d', strtotime("+2 day"));
            $aftertomorowMale = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->whereDate('consumer_rasbary.created_at',$aftertomorow)
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.sex', 'male')
            ->groupBy('consumer_id')
            ->get()
            ->count();
            $aftertomorowFeMale = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->whereDate('consumer_rasbary.created_at',$aftertomorow)
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.sex', 'female')
            ->groupBy('consumer_id')
            ->get()
            ->count();
        //+3
        $afteraftertomorow=date('Y-m-d', strtotime("+3 day"));
            $afteraftertomorowMale = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->whereDate('consumer_rasbary.created_at',$afteraftertomorow)
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.sex', 'male')
            ->groupBy('consumer_id')
            ->get()
            ->count();
            $afteraftertomorowFeMale = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->whereDate('consumer_rasbary.created_at',$afteraftertomorow)
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.sex', 'female')
            ->groupBy('consumer_id')
            ->get()
            ->count();



        $allInfoMale = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            //->whereDate('consumer_rasbary.created_at',$date)
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.sex', 'male')
            ->groupBy('consumer_id')
            ->get();


        $allInfoFeMale = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.sex', 'female')
            ->groupBy('consumer_id')
            ->get();


        $young = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.age', '>=', 12)
            ->where('consumers.age', '<=', 16)
            ->groupBy('consumer_id')
            ->get()->count();


        $youngAdults = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.age', '>', 16)
            ->where('consumers.age', '<=', 18)
            ->groupBy('consumer_id')
            ->get()->count();

        $adults = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.age', '>', 18)
            ->where('consumers.age', '<=', 29)
            ->groupBy('consumer_id')
            ->get()->count();

        $middleAged = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.age', '>', 29)
            ->where('consumers.age', '<=', 60)
            ->groupBy('consumer_id')
            ->get()->count();

        $old = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.age', '>', 60)
            ->groupBy('consumer_id')
            ->get()->count();





        return view('admin.venues.show', compact('venue','allInfoMale','allInfoFeMale','todayMale','todayFeMale','yesterdayMale','yesterdayFeMale'
    ,'lastyesterdaydayMale','lastyesterdayFeMale','lastlastYesterdayMale','lastlastYesterdayFeMale','tomorowMale',
    'tomorowFeMale','aftertomorowMale','aftertomorowFeMale','afteraftertomorowMale','afteraftertomorowFeMale',
    'young','youngAdults','adults','middleAged','old','roleuser'));
    }

    public function destroy(Venue $venue)
    {
        abort_if(Gate::denies('venue_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $venue->delete();

        return back();
    }

    public function massDestroy(MassDestroyVenueRequest $request)
    {
        Venue::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function showForAd(Venue $venue)
    {

        $user = \Auth::user();
        $roleuser=$user->roles->first()->title;
        abort_if(Gate::denies('venue_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $today=date('Y-m-d');
        $todayMale = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->whereDate('consumer_rasbary.created_at',$today)
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.sex', 'male')
            ->get()
            ->count();
        $todayFeMale = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->whereDate('consumer_rasbary.created_at',$today)
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.sex', 'female')
            ->get()
            ->count();
        //-1
        $yesterday=date('Y-m-d', strtotime("-1 day"));
        $yesterdayMale = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->whereDate('consumer_rasbary.created_at',$yesterday)
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.sex', 'male')
            ->get()
            ->count();
         $yesterdayFeMale = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->whereDate('consumer_rasbary.created_at',$yesterday)
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.sex', 'female')
            ->get()
            ->count();
        //-2
        $lastyesterday=date('Y-m-d', strtotime("-2 day"));
        $lastyesterdaydayMale = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->whereDate('consumer_rasbary.created_at',$lastyesterday)
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.sex', 'male')
            ->get()
            ->count();
         $lastyesterdayFeMale = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->whereDate('consumer_rasbary.created_at',$lastyesterday)
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.sex', 'female')
            ->get()
            ->count();
        //-3
        $lastlastYesterday=date('Y-m-d', strtotime("-3 day"));
        $lastlastYesterdayMale = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->whereDate('consumer_rasbary.created_at',$lastlastYesterday)
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.sex', 'male')
            ->get()
            ->count();
         $lastlastYesterdayFeMale = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->whereDate('consumer_rasbary.created_at',$lastlastYesterday)
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.sex', 'female')
            ->get()
            ->count();
        //+1
        $tomorow=date('Y-m-d', strtotime("+1 day"));
        $tomorowMale = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->whereDate('consumer_rasbary.created_at',$tomorow)
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.sex', 'male')
            ->get()
            ->count();
         $tomorowFeMale = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->whereDate('consumer_rasbary.created_at',$tomorow)
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.sex', 'female')
            ->get()
            ->count();
        //+2
        $aftertomorow=date('Y-m-d', strtotime("+2 day"));
            $aftertomorowMale = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->whereDate('consumer_rasbary.created_at',$aftertomorow)
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.sex', 'male')
            ->get()
            ->count();
            $aftertomorowFeMale = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->whereDate('consumer_rasbary.created_at',$aftertomorow)
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.sex', 'female')
            ->get()
            ->count();
        //+3
        $afteraftertomorow=date('Y-m-d', strtotime("+3 day"));
            $afteraftertomorowMale = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->whereDate('consumer_rasbary.created_at',$afteraftertomorow)
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.sex', 'male')
            ->get()
            ->count();
            $afteraftertomorowFeMale = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->whereDate('consumer_rasbary.created_at',$afteraftertomorow)
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.sex', 'female')
            ->get()
            ->count();



        $allInfoMale = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            //->whereDate('consumer_rasbary.created_at',$date)
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.sex', 'male')
            ->get();


        $allInfoFeMale = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.sex', 'female')
            ->get();


        $young = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.age', '>=', 12)
            ->where('consumers.age', '<=', 16)
            ->get()->count();


        $youngAdults = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.age', '>', 16)
            ->where('consumers.age', '<=', 18)
            ->get()->count();

        $adults = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.age', '>', 18)
            ->where('consumers.age', '<=', 29)
            ->get()->count();

        $middleAged = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.age', '>', 29)
            ->where('consumers.age', '<=', 60)
            ->get()->count();

        $old = DB::table('venues')
            ->join('rasbary_venue', 'rasbary_venue.venue_id', '=', 'venues.id')
            ->join('consumer_rasbary', 'consumer_rasbary.rasbary_id', '=', 'rasbary_venue.rasbary_id')
            ->join('consumers', 'consumer_rasbary.consumer_id', '=', 'consumers.id')
            ->where('consumers.age', '>', 60)
            ->get()->count();





        return view('admin.venues.show', compact('venue','allInfoMale','allInfoFeMale','todayMale','todayFeMale','yesterdayMale','yesterdayFeMale'
    ,'lastyesterdaydayMale','lastyesterdayFeMale','lastlastYesterdayMale','lastlastYesterdayFeMale','tomorowMale',
    'tomorowFeMale','aftertomorowMale','aftertomorowFeMale','afteraftertomorowMale','afteraftertomorowFeMale',
    'young','youngAdults','adults','middleAged','old','roleuser'));
    }

    public function adLocations($venueID)
    {
        $venue=Venue::where('id', $venueID)->first();
        $ads  = DB::table('ad_venue')->join('ads', 'ads.id', '=', 'ad_venue.ad_id')
        ->where('ad_venue.venue_id', $venue->id)
        ->get();

        $user = \Auth::user();

        $roleuser=$user->roles->first()->title;


        return view('admin.venues.adsIn', compact('ads','roleuser'));
    }

}
