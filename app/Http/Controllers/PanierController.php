<?php

namespace App\Http\Controllers;

use App\Models\CommandesModel;
use Illuminate\Http\Request;
use App\Models\PanierModel;
use App\Models\ProduitsModel;
class PanierController extends Controller
{
    public function index(){
    $panier = PanierModel::select("panier.id","nomProduit","panier_produit.quantite","stock","panier_produit.prix")->join('panier_produit','panier_id','=',"panier.id")
    ->join("produits","produit_id","=","produits.id")
    ->where("panier.user_id","=","1")->get();
//dd($panier);
    return view("panier",["panier"=>$panier]);
    }

    public function add(Request $req){
        $id=$req->get("id");
        $producteur_id=$req->get("producteur_id");
        $stock=$req->get("stock");
       $panier=PanierModel::create([
           "client_id"=>1,

       ]);

       $produit=ProduitsModel::join("produit_user","produits.id","=","produit_id")
       ->where("user_id","=",$producteur_id)
       ->where("produit_id","=",$id)->get();
       PanierModel::find($panier["id"])->produits()->attach($panier,["produit_id"=>$id,"stock"=>$stock,"quantite"=>1,"prix"=>$produit[0]["prix"]]);
    }

    public function delete(Request $req){
        $id=$req->get("id");
        $adresse=$req->get("adresse");
        /*$panier= PanierModel::with("produits",function($produits) use ($id){
                $produits->whereHas("panier.id","=",$id);
        })->get();*/
        $panier=PanierModel::with("produits")->where("panier.id",$id)->get();

        $commande=CommandesModel::create([
            "user_id"=>1,
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

    public function listeAdresse(){
        $addresse=CommandesModel::select("addresse")->where("user_id",1)->get();
        return response()->json([$addresse]);
    }
}