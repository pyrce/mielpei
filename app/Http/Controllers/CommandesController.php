<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommandesModel;
use App\Models\User;
use App\Post;
use PDF;
class CommandesController extends Controller
{
    public function index(){
      //  $commandes = CommandesModel::join("commande_produit","commande_produit.commande_id","=","commandes.id")->join("produits","commandes.id","=","produit_id")->get();
      /*  $commandes=CommandesModel::whereHas("produits",function($q){
           $q->where("commandes.client_id",1);
        })->get();*/
        $commandes=CommandesModel::with("produits")->where("user_id","=",1)->get();
        $total=[];  
        foreach($commandes as $c){
           
            $total[$c->id]=0;
      
               $somme=0;
            foreach($c->produits as $p){
                // print_r( $c);
            
                   $somme+=$p->pivot->prix*$p->pivot->quantite;
                 
                   $total[$c->id]=$somme; 
                   
            }
           
        }
      
     //dd($commandes);
        return view("commandes",["commandes"=>$commandes,"total"=>$total]);
    }

    public function show(Request $req,$id){
       
        $commande=CommandesModel::with("produits")->where("id","=",$id)->get();
       //dd($commandes);
       return view("detail_commande",["commande"=>$commande[0]]);
    }

    public function topdf($id){
     
        $commande=CommandesModel::with("produits")->where("id","=",$id)->get();
        $user=User::find(1);
    //   return view("pdf",["commande"=>$commande[0],"user"=>$user]);
        return PDF::loadView('pdf',["user"=>$user,"commande"=>$commande[0]])
        ->setPaper('a4', 'landscape')
        ->setWarnings(false)
       // ->save(public_path("storage/fichier.pdf"))
        ->stream();
    }
}
