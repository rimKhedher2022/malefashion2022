<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //fonction qui permet d'afficher le dashboard admin

    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
