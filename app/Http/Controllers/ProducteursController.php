<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsersModel;
use App\Models\ProduitsModel;
use App\Models\CommandesModel;
use App\Models\User;

class ProducteursController extends Controller
{
    
    public function show(Request $req){
        $prodid=$req->route("id");
        //dd($prodid);
        $producteur=UsersModel::where("id","=",$prodid)->get();
        $produits=ProduitsModel::whereHas("users",function($produits) use($prodid){
            $produits->where("users.id",$prodid);
        } )->get();
        return view("producteurs",["producteur"=>$producteur[0],"produits"=>$produits ]);

    }

    public function index(Request $req){

        //$producteur=ProduitsModel::with("users")->where("user_id","=",3)->get();
       //$producteur=ProducteursModel::find(1)->produits()->get();
        $producteur= ProduitsModel::join('produit_user','produit_id','=',"produits.id")->where("user_id",3)->get();
      
        $commandes=CommandesModel::join("commande_produit","commande_id","=","commandes.id")
        ->join("produits","produits.id","=","commande_produit.produit_id")
        ->join("produit_user","produit_user.produit_id","=","produits.id")
        ->join("users","users.id","=","commandes.user_id")
        ->where("commande_produit.user_id","=",3)->get();

     //dd($commandes);
        return view("mesproduits",["producteur"=>$producteur,"commandes"=>$commandes]);

    }
    public function ajout(Request $req){
        $data=$req->get("data");
        $nom=$data["nomProduit"];
        $prix=$data["prix"];
        $stock=$data["stock"];
        $producteur_id=$data["producteur_id"];
        $produit=new ProduitsModel;
    
        $produit->nomProduit=$nom;
        $produit->save();
    
       /* $produit->producteurs()->create([
            "producteur_id"=>1,
            "produit_id"=>$produit["id"],
            "stock"=>$stock,
            "prix"=>$prix
        ]);*/
        ProduitsModel::find($produit["id"])->producteurs()->attach($produit,["producteur_id"=>$producteur_id,"stock"=>$stock,"prix"=>$prix]);
    
    }
    
    public function deleteProduit(Request $req){
        $id=$req->get("id");
        UsersModel::find(1)->produits()->detach($id);
      
    }
    public function infos($id){
        $producteur=User::find($id)->get();
        return view("infos",["producteur"=>$producteur[0]]);
      
    }
    public function addstock(Request $req){
        $data=$req->get("data");
        $produitid=$data["produitid"];
        $stock=$data["stock"];
    
        $user=UsersModel::find(3);
        $attr=array();
        $attr["stock"]=$stock;
        $user->produits()->updateExistingPivot($produitid, $attr);
       // $user->produits()->sync(["stock"=>$stock]);
        
     
    }

    public function modifier(Request $req){
        $data=$req->all()["data"];

        User::where("id",2)->update($data);
        
        //$user=User::find(2)->
    }
}
