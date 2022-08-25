<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Commande;
use App\LigneCommande;

class CommandeController extends Controller
{
    //
    public function store (Request $request)
    {
         //vérifier si une commande est en cours pour ce client
         $commande = Commande::where('client_id',Auth::user()->id)->where('etat','en cours')->first();

                if($commande)
                { 

                    //ckeck if product existe

                    $existe=false; 
                    foreach ($commande->ligneCommandes as $lignec)
                    {
                    if($lignec->product_id== $request->idproduct)
                    {
                        $existe=true;
                        $lignec->qte+= $request->qte;
                        $lignec->update();
                    }



                        
                    }

                    if(!$existe)

                    {
                        $lc = new LigneCommande();
                        $lc->qte= $request->qte;
                        $lc->product_id= $request->idproduct;
                        $lc->commande_id = $commande->id;
                        $lc->save();
                        echo "produit commandé";

                    }
                    //creatio de ligne de commande 
                    
                    return redirect('/client/cart')->with('success','produit commandee');

                }


            else // cmd en cours n'existe pas
            {

                $commande = new Commande();
                    $commande->client_id = Auth::user()->id ;
                    if( $commande->save() )
                    {
                            //creatio de ligne de commande 
                            $lc = new LigneCommande();
                            $lc->qte= $request->qte;
                            $lc->product_id= $request->idproduct;
                            $lc->commande_id = $commande->id;
                            $lc->save();
                            //echo "produit commandé";
                            return redirect('/client/cart')->with('success','produit commandee');
                    }

                    else{
                        return redirect()->back()->with('error','impossible de commander le produit');
                    }


            }

        

    }


    public function ligneCommandeDestroy($idlc)

    {
        $lc= LigneCommande::find($idlc);
        $lc->delete();
        return  redirect()->back()->with('success','Ligne de commande supprimé');
    }


    
}
