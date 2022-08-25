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

    public function productDetails($id)

    {
        $product = Product::find($id);
        $products = Product::where('id','!=',$id)->get();

        $categories =Category::all();
        return view ('guests.product-details')->with('categories',$categories)->with('product',$product)->with('products',$products);
    }


    public function shop ($idcategory)

    {
        $category = Category::find($idcategory) ;// nejib el category

        $products = $category->products;

        $categories =Category::all();
        return view ('guests.shop')->with('categories',$categories)->with('products',$products);
    }


    public function search(Request $request)
    {
 $products = Product::where('name','LIKE','%'. $request->keywords .'%')->get();
 $categories =Category::all();
return view('guests.shop')->with('categories',$categories)->with('products',$products);


    }
}
