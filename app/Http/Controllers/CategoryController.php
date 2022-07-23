<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // fonction qui permet d'afficher la liste des categories
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index')->with('categories',$categories);
    }



// ajouter un categori dans la base
    public function store(Request $request)
    {
        $request->validate([
         'name'=>'required',
         'description'=>'required'

        ]);


        $categoty = new Category();

        $categoty->name=$request->name;
        $categoty->description=$request->description;

        if($categoty->save())
        {return redirect()->back();}

        else{
            echo "error";
        }
        
    }



    public function destroy ($id){

        $categotie = Category::find($id);
        if($categotie->delete())

        {
            return redirect()->back();

        }

        else
        {
            echo "error";
        }
    }
}
