<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;

class ProductController extends Controller
{
    //


    public function index()
    {
        $products = Product::all();
        $categories = Category::all();
        return view('admin.products.index')->with('products', $products)->with('categories',$categories);
    }




    public function store(Request $request)
    {


        $produit = new Product();
        $produit->name=$request->name;
        $produit->category_id=$request->categorie;
        $produit->description=$request->description;
        $produit->price=$request->price;
        $produit->qte=$request->qte;


        $newname = uniqid();
        $image = $request->file('photo');
        $newname .= "." . $image->getClientOriginalExtension();
        $destinationPath = 'uploads';
        $image->move($destinationPath, $newname);

        $produit->photo=$newname;
        $produit->save();

        if($produit->save())
        {return redirect()->back();}

        else{
            echo "error";
        }
    }



    public function destroy ($id){

        $produit = Product::find($id);

        $file_path=public_path().'/uploads/'.$produit->photo;
        unlink($file_path);
        if($produit->delete())

        {
            return redirect()->back();

        }

        else
        {
            echo "error";
        }
    }



    public function update(Request $request)
    {

        $produit = Product::find($request->idproduct);





        // $produit = new Product();
         $produit->name=$request->name;
         $produit->description=$request->description;
         $produit->price=$request->price;
         $produit->qte=$request->qte;


         //upload photo
         if($request->file('photo'))
         {

            $file_path=public_path().'/uploads/'.$produit->photo;
            unlink($file_path);

                $newname = uniqid();
            $image = $request->file('photo');
            $newname .= "." . $image->getClientOriginalExtension();
            $destinationPath = 'uploads';
            $image->move($destinationPath, $newname);

            $produit->photo=$newname;


         }

     
        // $produit->save();

        if($produit->update())
        {return redirect()->back();}

        else{
            echo "error";
        }
    }
}
