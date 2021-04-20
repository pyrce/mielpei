<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UsersModel;
use App\Models\ProduitsModel;
use App\Models\CommandesModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProducteursController extends Controller
{
    public function __construct()
    {
        //$this->authorizeResource(User::class, 'producteur');
    }
    public function show(Request $req)
    {
        $prodid = $req->route("id");

        $producteur = UsersModel::where("id", "=", $prodid)->get();
        $produits = ProduitsModel::with("users")->whereHas("users", function ($produits) use ($prodid) {
            $produits->where("user_id", $prodid);
        })->get();
        return view("producteurs", ["producteur" => $producteur[0], "produits" => $produits]);
    }

    public function index(Request $req)
    {

            return view("producteurs.dashboard");

    }

    public function showcommandes(Request $req, $id)
    {

        $commande = CommandesModel::with("produits","addresse_livraison","addresse_facturation")->where("id", "=", $id)->get();

        return view("producteurs.detail_commande", ["commande" => $commande[0]]);
    }
public function MesProduits()
{
                $producteur = ProduitsModel::join('produit_user', 'produit_id', '=', "produits.id")->where("user_id", Auth::user()->id)->paginate(5);
       

                return view("producteurs.mesproduits" , ["producteur" => $producteur]);

}
    public function commandes(){


            $commandes = CommandesModel::join("commande_produit", "commande_id", "=", "commandes.id")
            ->join("produits", "produits.id", "=", "commande_produit.produit_id")
            ->join("produit_user", "produit_user.produit_id", "=", "produits.id")
            ->join("users", "users.id", "=", "commandes.user_id")
            //->join("adresse_livraison"." as al","commandes.id","=","al.commande_id")
            //->join("adresse_facturation","commandes.id","=","adresse_facturation.commande_id")
            ->where("commande_produit.user_id", "=", Auth::user()->id)->get();
            $total = [];
            foreach ($commandes as $c) {
    
                $total[$c->id] = 0;
    
                $somme = 0;
                foreach ($c->produits as $p) {
                    // print_r( $c);
    
                    $somme += $p->pivot->prix * $p->pivot->quantite;
    
                    $total[$c->id] = $somme;
                }

               $c["total"]=$total;
            }
            return view("producteurs.commandes", ["commandes" => $commandes]);
    }
    public function ajout(Request $req)
    {
        $data = $req->get("data");
        $nom = $data["nomProduit"];
        $prix = $data["prix"];
        $stock = $data["stock"];
        $produit = new ProduitsModel;

        $produit->nomProduit = $nom;
        $produit->save();

        ProduitsModel::find($produit["id"])->users()->attach($produit["id"], ["user_id" => Auth::user()["id"], "stock" => $stock, "prix" => $prix]);
    }

    public function deleteProduit(Request $req)
    {
        $id = $req->get("id");
        UsersModel::find(2)->produits()->detach($id);
    }
    public function infos($id)
    {
        $producteur = User::find($id);
        return view("infos", ["producteur" => $producteur]);
    }
    public function addstock(Request $req)
    {
        $data = $req->get("data");
        $produitid = $data["produitid"];
        $stock = $data["stock"];

        $attr = array();
        $attr["stock"] = $stock;

        User::find(Auth::user()["id"])->produits()->updateExistingPivot($produitid, ["stock"=>$stock]);

    }

    public function modifier(Request $req)
    {
        $data = $req->all()["data"];
        $id = $req->all()["id"];
        User::where("id", $id)->update($data);
    }
}
