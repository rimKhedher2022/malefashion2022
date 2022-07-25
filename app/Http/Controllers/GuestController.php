<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product ;

class GuestController extends Controller
{
    //

    public function home()
    {
        $produits = Product::all(); // recupérer toute les produits de la base de donnes
        $categories =Category::all();
        return view('guests.home')->with('produits',$produits)->with('categories',$categories);

    }
}
