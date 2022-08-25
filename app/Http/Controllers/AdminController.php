<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\profile;
//use Auth ;

class AdminController extends Controller
{
    //fonction qui permet d'afficher le dashboard admin

    public function dashboard()
    {
        return view('admin.dashboard');
    }


    public function profile()


    {
        return view('admin.profile');
    }

    public function updateProfile(Request $request)
    {

        Auth::user()->name = $request->name;
        Auth::user()->email = $request->email;
        if($request->password)
        {
            Auth::user()->password = Hash::make($request->password);
        }
        Auth::user()->update; /////// update() ne marche pas
        return redirect('/admin/profile')->with('success','admin modifié avec succes');

    }
}
