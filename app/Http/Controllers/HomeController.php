<?php

namespace App\Http\Controllers;

use App\Setting;
use App\Speaker;
use App\Schedule;
use App\Venue;
use App\Hotel;
use App\Gallery;
use App\Sponsor;
use App\Faq;
use App\Price;
use App\Amenity;
use App\Consumer;
use App\Rasbary;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    public function index()
    {
        $settings = Setting::pluck('value', 'key');
        $speakers = Speaker::all();
        $schedules = Schedule::with('speaker')
            ->orderBy('start_time', 'asc')
            ->get()
            ->groupBy('day_number');
        $venues = Venue::all();
        $hotels = Hotel::all();
        $galleries = Gallery::all();
        $sponsors = Sponsor::all();
        $faqs = Faq::all();
        $prices = Price::with('amenities')->get();
        $amenities = Amenity::with('prices')->get();

        return view('home', compact('settings', 'speakers', 'schedules', 'venues', 'hotels', 'galleries', 'sponsors', 'faqs', 'prices', 'amenities'));
    }

    public function view(Speaker $speaker)
    {
        $settings = Setting::pluck('value', 'key');
        
        return view('speaker', compact('settings', 'speaker'));
    }
    public function rasbary($mac)
    {
        
        $rab = Rasbary::where('key', "sakka")->first();
        $venu = $rab->venues()->first();
        $add = DB::table('ads')
            ->join('ad_venue', 'ad_venue.ad_id', '=', 'ads.id')
            ->where('ad_venue.venue_id', '=', $venu->id)
            ->where('ads.priority', 11)
            ->get() ;

       

   
        $ads=$venu->ads()->first();
        $con=DB::table('consumers')->where('Mac',"=", $mac)->get();    
        if(count($con) >0){
            foreach($add as $key => $ad){
            if($ad->priority==11)
            {
                $today=date('Y-m-d');

                DB::table('ad_consumer')->insert(
                        array(
                            'ad_id'     =>   $ad->id, 
                            'consumer_id'   =>   $con->first()->id,
                            'created_at'  =>  $today,
                        )
                ); 

            }
           // return redirect('/bean.mp4');
        
        }
           
            return view('rasbary.rasb',compact('mac','venu','ads','add'));

        }else{
      }
        return view('rasbary.rasb',compact('mac','venu','ads'));
    }
   
    public function storeMe(Request $request)
    {
        $rab = Rasbary::where('key', "sakka")->first();
       
        $consumer = Consumer::create($request->all());
        $consumer->ads()->sync($request->input('ads', []));
        $today=date('Y-m-d');

        DB::table('consumer_rasbary')->insert(
            array(
                   'rasbary_id'     =>   $rab->id, 
                   'consumer_id'   =>   $consumer->id,
                   'created_at'  =>  $today,
            )
       );

       return redirect("/sakka/$consumer->Mac");
     
    }
   
}
