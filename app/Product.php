<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //

    public function category(){

        return $this->belongsTo(Category::class,'category_id','id');
        
    }


    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id', 'id');
    }
    

    public function ligneCommande(){

        return $this->hasMany(LigneCommande::class,'product_id','id');
        
    }


}

