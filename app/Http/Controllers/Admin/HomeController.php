<?php

namespace App\Http\Controllers\Admin;
use App\Role;
use App\User;
use Illuminate\Support\Facades\DB;

class HomeController
{
    public function index()
    {
        $user = \Auth::user();
        $roleuser=$user->roles->first()->title;

        $arrayUser = array();
        for ($i = 0; $i < 12; ++$i) {
            $arrayUser[] = DB::table('users')->whereMonth('created_at', $i+1)->get()->count();;
        }

        $arrayLocation = array();
        for ($i = 0; $i < 12; ++$i) {
            $arrayLocation[] = DB::table('venues')->whereMonth('created_at', $i+1)->get()->count();;
        }
        $arrayrasbaries = array();
        for ($i = 0; $i < 12; ++$i) {
            $arrayrasbaries[] = DB::table('rasbaries')->whereMonth('created_at', $i+1)->get()->count();;
        }

       
        


        return view('admin.home',compact('arrayUser','arrayLocation','arrayrasbaries','user','roleuser'));
    }
}
