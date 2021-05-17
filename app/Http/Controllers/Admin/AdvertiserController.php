<?php
/**
*this controller use to manipulate advertiser partner by admin
 */
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\AdvertiserPartner;
use App\LocationPartner;
use App\User;
use App\Location;
use App\Domaine;
use App\Tag;
use Spatie\Permission\Models\Permission;

class AdvertiserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advertisers = AdvertiserPartner::all();
        return view('admin.advertiser.index',compact('advertisers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions = ['Tunis','Sousse','Monastir'];
        $secteurs = Domaine::all();
        $tags = Tag::all();
        $advertisers = AdvertiserPartner::all();
        return view('Advertiser.Register', compact('advertisers','regions','secteurs','tags'));
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
            'email' => 'required|email|max:255|unique:advertiser_partners',
            'password' => 'required|string| min:8|confirmed',
            'location_region' => 'required|string',
            'location_secteur' => 'required|string',
            'location_address' => 'required|string',
            'email_pro' => 'required|email',
            'post' => 'required|string',
            'website' => 'required|string',
            'location_tel' => 'required|string|min:8|max:12',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $regions = ['Tunis','Sousse','Monastir'];
        $secteurs = Domaine::all();
        $tags = Tag::all();
        $advertisers = new AdvertiserPartner();
        $image = $request->file('logo');
        $advertisers->location_name = $request->input('location_name');
        // $fileName = uniqid($locationpartes->location_name) . '.' . $file->getClientOriginalExtension();
        $advertisers->first_name = $request->input('first_name');
        $advertisers->last_name = $request->input('last_name');
        $advertisers->post = $request->input('post');
        $advertisers->phone = $request->input('phone');
        $advertisers->email = $request->input('email');
        $advertisers->password = $request->input('password');
        $advertisers->location_region = $request->input('location_region');
        $advertisers->location_secteur = $request->input('location_secteur');
        $advertisers->location_address = $request->input('location_address');
        $advertisers->email_pro = $request->input('email_pro');
        $advertisers->website = $request->input('website');
        $advertisers->social_media = $request->input('social_media');
        $advertisers->location_tel = $request->input('location_tel');
        $advertisers->logo = $image;
        $request->input('permission') ? $request->input('permission') : [];
        $destinationPath = 'image/Advertisers';
        $profileImage = $advertisers->location_name . "." . $image->getClientOriginalExtension();
        $image->move($destinationPath, $profileImage);
        $advertisers->logo = $profileImage;
        $advertisers->save();
        return view('auth.advertiserPartnerLogin');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(AdvertiserPartner $advertiser)
    {
        return view('admin.advertiser.show', compact('advertiser'));
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
    /**
     * This Function use to validate advertiser account.
     *
     */
    public function validation($id)
    {
        $advertiser = AdvertiserPartner::findOrFail($id);
        if ($advertiser->status == 0) {
            $advertiser->status = 1;
            $advertiser->save();
            $user = User::create([
                'name' => $advertiser->location_name,
                'email' => $advertiser->email,
                'password' => bcrypt($advertiser->password)
            ]);

            $user->roles()->sync(3);
        }
        return view('admin.advertiser.show', compact('advertiser'));
    }
}
