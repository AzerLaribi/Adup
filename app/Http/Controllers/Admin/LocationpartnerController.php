<?php

/**
*this controller use to manipulate location partner by admin
 */
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\LocationPartner;
use App\User;
use App\Venue;
use App\Type;
use App\Tags;
class LocationpartnerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locationpartners = LocationPartner::all();
        return view('admin.locationpartner.index',compact('locationpartners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions = ['Tunis','Sousse','Monastir'];
        $secteurs = Type::all();
        $tags = Tags::all();
        $locationpartes = LocationPartner::all();
        return view('LocationPartner.Register', compact('locationpartes','regions','secteurs','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Validate = $request->validate([
            'first_name' => 'required|regex:/^[a-zA-Z]+$/u|max:20',
            'last_name' => 'required|regex:/^[a-zA-Z]+$/u|max:20',
            'phone' => 'required|string|min:8|max:12',
            'email' => 'required|email|max:255|unique:location_partners',
            'password' => 'required|string| min:8|confirmed',
            'location_region' => 'required|string',
            'location_secteur' => 'required|string',
            'location_address' => 'required|string',
            'email_pro' => 'required|email',
            'website' => 'required|string',
            'location_tel' => 'required|string|min:8|max:12',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $regions = ['Tunis','Sousse','Monastir'];
        $secteurs = Type::all();
        $tags = Tags::all();
        $locationpartes = new LocationPartner();
        $location = new Location();
        $image = $request->file('logo');
        $locationpartes->location_name = $request->input('location_name');
        $locationpartes->first_name = $request->input('first_name');
        $locationpartes->last_name = $request->input('last_name');
        $locationpartes->phone = $request->input('phone');
        $locationpartes->email = $request->input('email');
        $locationpartes->password = $request->input('password');
        $locationpartes->location_region = $request->input('location_region');
        $locationpartes->location_secteur = $request->input('location_secteur');
        $locationpartes->location_address = $request->input('location_address');
        $locationpartes->location_tags = $request->input('location_tags');
        $locationpartes->email_pro = $request->input('email_pro');
        $locationpartes->website = $request->input('website');
        $locationpartes->social_media = $request->input('social_media');
        $locationpartes->location_tel = $request->input('location_tel');
        $locationpartes->logo = $image;
        $destinationPath = 'image/LocationPartner';
        $profileImage = $locationpartes->location_name . "." . $image->getClientOriginalExtension();
        $image->move($destinationPath, $profileImage);
        $locationpartes->logo = $profileImage;
        $location->name = $request->input('location_name');
        $location->region = $request->input('location_region');
        $location->address = $request->input('location_address');
        $location->type = $request->input('location_secteur');
        $location->tags = $request->input('location_region');
        $location->tags = $request->input('location_tags');
        $locationpartes->save();
        $location->save();
        return view('auth.locationPartnerLogin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(LocationPartner $locationpartner)
    {
        return view('admin.locationpartner.show', compact('locationpartner'));
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
        $locationpartner = LocationPartner::findOrFail($id);
        $locationpartner->delete();

        return redirect()->route('admin.locationpartner.index');
    }
    public function validation($id)
    {
        $locationpartner = LocationPartner::findOrFail($id);
        if ($locationpartner->status == 0) {
            $locationpartner->status = 1;
            $locationpartner->save();
            $venues = Venue::create([
                'name' => $locationpartner->location_name,
                'description' => $locationpartner->location_name,
                'address' => $locationpartner->location_address,
                'logo' => $locationpartner->logo,
                'latitude' => 'XXX',
                'longitude' => 'XXX',
                'region' => $locationpartner->location_region,
            ]);
            $user = User::create([
                'name' => $locationpartner->first_name,
                'email' => $locationpartner->email,
                'password' => bcrypt($locationpartner->password)
            ]);
            $user->roles()->sync(4 );
        }
        return view('admin.locationpartner.show', compact('locationpartner'));
    }
}
