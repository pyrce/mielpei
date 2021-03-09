<?php

namespace App\Http\Controllers;

use App\Models\CommandesModel;
use Illuminate\Http\Request;
use App\Models\PanierModel;
use App\Models\ProduitsModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PanierController extends Controller
{

    public function index()
    {
        // $panier = PanierModel::select("panier.id","nomProduit","panier_produit.quantite","stock","panier_produit.prix")
        // ->join('panier_produit','panier_id','=',"panier.id")
        // ->join("produits","produit_id","=","produits.id")
        // ->where("panier.user_id","=","6")->get();
        $panier = PanierModel::with('produits')->where("panier.user_id", Auth::user()["id"])->get();
        $total = [];
        foreach ($panier as $c) {

            $total[$c->id] = 0;

            $somme = 0;
            foreach ($c->produits as $p) {

                $somme += $p->pivot->prix * $p->pivot->quantite;

                $total[$c->id] = $somme;
            }
        }
    
$total= sizeof($total) >0 ? $total[$panier[0]["id"]] : 0;

        return view("panier", ["panier" => $panier, "total" => $total ]);
    }

    public function add(Request $req)
    {
        $id = $req->get("id");
        $producteur_id = $req->get("producteur_id");
        $stock = $req->get("stock");
        $panier = PanierModel::where("user_id", Auth::user()["id"])->get();

        if (sizeof($panier) == 0) {
            $panier = PanierModel::create([
                "user_id" => Auth::user()["id"],

            ]);
        }
        $produit = ProduitsModel::with("users")->whereHas("users", function ($user) use ($producteur_id, $id) {

            $user->where("user_id", $producteur_id)->where("produit_id", $id);
        })->get();

        $panier[0]->produits()->attach($panier[0]["id"], ["produit_id" => $id, "user_id" => $producteur_id, "stock" => $stock, "quantite" => 1, "prix" => $produit[0]["users"][0]["pivot"]["prix"]]);

    }

    public function paiement(Request $req)
    {
        $id = $req->get("id");
        $addresse_livraison = $req->get("addresse_livraison");
        $addresse_facturation = $req->get("addresse_facturation");

        $panier=PanierModel::with("produits")->where('panier.user_id',Auth::user()["id"])->get();

        $list=[];
        $commande = CommandesModel::create([
            "user_id" => Auth::user()["id"],
            "addresse_livraison" => $addresse_livraison,
            "addresse_facturation" => $addresse_facturation,
            "date" =>  date("Y-m-d"),
            "etat" => "en cours"
        ]);
//dd($panier[0]["produits"] );
        foreach ($panier[0]["produits"] as $p) {

            $commande->produits()
                ->attach($commande, [
                     "commande_id" => $commande["id"],
                     "produit_id"=>$p["pivot"]["produit_id"],
                     "user_id" => $p["pivot"]["user_id"],
                     "quantite" => $p["pivot"]["quantite"],
                     "prix" => $p["pivot"]["prix"]
                 ]);

            $prod=ProduitsModel::with("users")->whereHas("users",function($produit) use($p){
               
                $produit->where("produit_id",$p["pivot"]["produit_id"]);
            })->where("produits.id",$p["id"])->first();

            $stock=$prod["users"][0]["pivot"]["stock"]-$p["pivot"]["quantite"];

            User::find(Auth::user()["id"])->produits()->updateExistingPivot($p["pivot"]["produit_id"], ["stock"=>$stock]);

            PanierModel::find($id)->produits()->detach($p["produit_id"]);

        }

    }

    public function updateqte(Request $req)
    {
        $id = $req->get("id");
        $value = $req->get("value");
        $panier = PanierModel::where("user_id", Auth::user()["id"])->get();

        $panier->produits()->updateExistingPivot($id, ["quantite" => $value]);
    }

    public function remove(Request $req)
    {
        $id = $req->get("id");
        $panier = $req->get("panier");
        $panier = PanierModel::find($panier);

        $panier->produits()->detach($id);
    }

    public function listeAdresseLivraion()
    {
        $addresse = CommandesModel::select("addresse_livraison")->distinct()->where("user_id", Auth::user()["id"])->get();
        return response()->json([$addresse]);
    }

    public function listeAdresseFacturation()
    {   
        $addresse = CommandesModel::select("addresse_facturation")->distinct()->where("user_id", Auth::user()["id"])->get();
        return response()->json([$addresse]);
    }
}
