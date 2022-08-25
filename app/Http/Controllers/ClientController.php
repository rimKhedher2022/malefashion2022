<?php

namespace App\Http\Controllers;

use App\Category;
use App\Review;
use App\Commande;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
   //fonction qui permet d'afficher le dashboard client


    public function dashboard()
    {
        return view('client.dashboard');
    }


    public function profile()
    {
        return view('client.profile');
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
        return redirect('/client/profile')->with('success','client modifié avec succes');

    }


    public function addReview(Request $request)

    {
        $review = new Review();
        $review->rate = $request->rate;
        $review->product_id = $request->product_id;
        $review->content = $request->content;
        $review->user_id = Auth::user()->id;
        $review->save();
        
        return redirect()->back();
    }

    public function cart()
    {
        $categories = Category::all();
        $commande = Commande::where('client_id',Auth::user()->id)->where('etat','en cours')->first();
        return view('guests.cart')->with('categories',$categories)->with('commande',$commande);
        
    }

    public function checkout(Request $request)
    {
        
            $commande = Commande::find($request->commande);
            $commande->etat ="payee";
            $commande->update();
            return redirect('/client/dashboard')->with('success','Commande payee avec succes ...');

    }
    public function mescommandes()
    {
        

           
         return view('client.commandes');

    }
}
