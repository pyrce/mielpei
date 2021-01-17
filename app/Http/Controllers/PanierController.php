<?php

namespace App\Http\Controllers;

use App\Models\CommandesModel;
use Illuminate\Http\Request;
use App\Models\PanierModel;
use App\Models\ProduitsModel;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class PanierController extends Controller
{
    
    public function index(){
    // $panier = PanierModel::select("panier.id","nomProduit","panier_produit.quantite","stock","panier_produit.prix")
    // ->join('panier_produit','panier_id','=',"panier.id")
    // ->join("produits","produit_id","=","produits.id")
    // ->where("panier.user_id","=","6")->get();
$panier=PanierModel::with('produits')->where("user_id",6)->get();
    $total=[];
    foreach($panier as $c){
       
        $total[$c->id]=0;
  
           $somme=0;
        foreach($c->produits as $p){
            // print_r( $c);
        
               $somme+=$p->pivot->prix*$p->pivot->quantite;
             
               $total[$c->id]=$somme; 
               
        }
       
    }

     return view("panier",["panier"=>$panier,"total"=>$total[$panier[0]["id"]] ]);
    }

    public function add(Request $req){
        $id=$req->get("id");
        $producteur_id=$req->get("producteur_id");
        $stock=$req->get("stock");
        $panier=PanierModel::where("user_id",6)->get();

if(sizeof($panier)==0){
     $panier=PanierModel::create([
           "user_id"=>6,

       ]);
     }
        $produit=ProduitsModel::with("users")->whereHas("users",function($user) use ($producteur_id,$id){

            $user->where("user_id",$producteur_id)->where("produit_id",$id);

        })->get(); 

       $panier[0]->produits()->attach($panier[0]["id"],["produit_id"=>$id,"user_id"=>$producteur_id,"stock"=>$stock,"quantite"=>1,"prix"=>$produit[0]["users"][0]["pivot"]["prix"] ]);
       session()->flash('message', 'This is a message!'); 
      // session()->forget('message');
        }

    public function delete(Request $req){
        $id=$req->get("id");
        $adresse=$req->get("adresse");
        /*$panier= PanierModel::with("produits",function($produits) use ($id){
                $produits->whereHas("panier.id","=",$id);
        })->get();*/
        $panier=PanierModel::with("produits")->where("panier.id",$id)->get();

        $commande=CommandesModel::create([
            "user_id"=>5,
            "addresse"=>$adresse,
            "date"=>  date("Y-m-d"),
            "etat"=>"en cours"
        ]);

        foreach($panier as $p){

            
        CommandesModel::find($commande["id"])->produits()
        ->attach($commande,[
            "commande_id"=>$commande["id"],
            "user_id"=>$p["produits"][0]["pivot"]["user_id"],
            "quantite"=>$p["produits"][0]["pivot"]["quantite"],
            "prix"=>$p["produits"][0]["pivot"]["prix"]
            ]);

        PanierModel::find($id)->produits()->detach($p["produit_id"]);
 
        }
    }

public function updateqte(Request $req){
    $id=$req->get("id");
    $value=$req->get("value");
    $panier=PanierModel::where("user_id",2)->get();

    $panier->produits()->updateExistingPivot($id, ["quantite"=>$value]);

}

public function remove(Request $req){
    $id=$req->get("id");
    $panier=$req->get("panier");
    $panier=PanierModel::find($panier);

    $panier->produits()->detach($id);

}

    public function listeAdresse(){
        $addresse=CommandesModel::select("addresse")->where("user_id",1)->get();
        return response()->json([$addresse]);
    }
}