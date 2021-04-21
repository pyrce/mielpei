<?php

namespace App\Http\Controllers;

use App\Models\CommandesModel;
use Illuminate\Http\Request;
use App\Models\PanierModel;
use App\Models\ProduitsModel;
use App\Models\AdresseFacturation;
use App\Models\AdresseLivraison;
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
        $user_id=Auth::user() ? Auth::user()["id"] : session()->get("user_id");
        $panier = PanierModel::with('produits')->where("panier.user_id", $user_id)->get();
        $total = [];
        foreach ($panier as $c) {

            $total[$c->id] = 0;

            $somme = 0;
            foreach ($c->produits as $p) {

                $somme += $p->pivot->prix * $p->pivot->quantite;

                $total[$c->id] = $somme;
            }
        }
    //$panier=sizeof($panier[0]["produits"])>0 ? $panier[0]["produits"]: 0;
$total= sizeof($total) >0 ? $total[$panier[0]["id"]] : 0;

        return view("panier", ["panier" => $panier, "total" => $total ]);
    }


    public function add(Request $req)
    {
        $id = $req->get("id");
        $producteur_id = $req->get("producteur_id");
        $stock = $req->get("stock");
        $panier=[];
        $user_id=0;

        if(Auth::user()!=null){

        $user_id=Auth::user()["id"];

        $panier = PanierModel::where("user_id", Auth::user()["id"])->get();
            if (sizeof($panier) == 0) {
               
            $panier = PanierModel::create([
                "user_id" => $user_id

            ]);
            }
        }else{
           if(session()->get("user_id")!=null){ 
                
                $user_id=session()->get("user_id");
                $panier = PanierModel::where("user_id", $user_id)->get();
                if (sizeof($panier) == 0) {
               
                    $panier = PanierModel::create([
                        "user_id" => $user_id
        
                    ]);
                    }
          
           }else{

            $iduser=PanierModel::orderBy('user_id', 'desc')->first();

            $user_id=$iduser["user_id"]+1;

            session()->put("user_id",$user_id);

            $panier = PanierModel::create([
                "user_id" => $user_id

            ]);
               //return  response()->json(["user_id"=> $user_id]);
           }

        
        } //dd($panier[0]["id"]);
        $produit = ProduitsModel::with("users")->whereHas("users", function ($user) use ($producteur_id, $id) {

            $user->where("user_id", $producteur_id)->where("produit_id", $id);
        })->get();

        $panier[0]->produits()->attach($panier[0]["id"], ["produit_id" => $id, "user_id" => $producteur_id, "stock" => $stock, "quantite" => 1, "prix" => $produit[0]["users"][0]["pivot"]["prix"]]);

    }

    public function paiement(Request $req)
    {   
        $user_id=Auth::user()!=null ? Auth::user()["id"] : session()->get("user_id");
        $data=$req->all();
        $voie_livraison = $data["voie_livraison"];
        $rue_livraison =  $data["rue_livraison"];
        $ville_livraison =  $data["ville_livraison"];
        $pays_livraison =  $data["pays_livraison"];

        $voie_facturation =  $data["voie_facturation"];
        $rue_facturation =  $data["rue_facturation"];
        $ville_facturation = $data["ville_facturation"];
        $pays_facturation =  $data["pays_facturation"];
//dd(get_defined_vars());
        $panier=PanierModel::with("produits")->where('panier.user_id',$user_id)->get();
        
        $list=[];
        $commande = CommandesModel::create([
            "user_id" => $user_id,
            "date" =>  date("Y-m-d"),
            "etat" => "en cours"
        ]);
//dd($panier );
        foreach ($panier[0]["produits"] as $p) {

            $commande->produits()
                ->attach($commande, [
                     "commande_id" => $commande["id"],
                     "produit_id"=>$p["pivot"]["prix"],
                     "user_id" => $p["pivot"]["user_id"],
                     "quantite" => $p["pivot"]["quantite"],
                     "prix" => $p["pivot"]["prix"]
                 ]);

            $prod=ProduitsModel::with("users")->whereHas("users",function($produit) use($p){
               
                $produit->where("produit_id",$p["pivot"]["produit_id"]);
            })->where("produits.id",$p["id"])->first();

            //$stock=$prod["users"][0]["pivot"]["stock"]-$p["pivot"]["quantite"];

            //User::find($prod["users"][0]["id"])->produits()->updateExistingPivot($p["pivot"]["produit_id"], ["stock"=>$stock]);

            PanierModel::find($panier[0]["id"])->produits()->detach($p["produit_id"]);

        }
       /* AdresseLivraison::create([
            "commande_id" => $commande["id"],
            "voie"=>$voie_livraison,
            "rue"=>$rue_livraison,
            "ville"=>$ville_livraison,
            "pays"=>$pays_livraison
        ]);*/
        $livraison=new AdresseLivraison();
        $livraison->commande_id=$commande["id"];
        $livraison->voie=$voie_livraison;
        $livraison->rue=$rue_livraison;
        $livraison->ville=$ville_livraison;
        $livraison->pays=$pays_livraison;
        $livraison->save();

        // AdresseFacturation::create([
        //     "commande_id" => $commande["id"],
        //     "voie"=>$voie_facturation,
        //     "rue"=>$rue_facturation,
        //     "ville"=>$ville_facturation,
        //     "pays"=>$pays_facturation
        // ]);
        $livraison=new AdresseFacturation();
        $livraison->voie=$voie_facturation;
        $livraison->commande_id=$commande["id"];
        $livraison->rue=$rue_facturation;
        $livraison->ville=$ville_facturation;
        $livraison->pays=$pays_facturation;
        $livraison->save();
        PanierModel::where("user_id",$user_id)->delete();
        return redirect("/commandes/pdf/".$commande["id"]);
    }

    public function updateqte(Request $req)
    {
        $user_id=Auth::user() ? Auth::user() : session()->get("user_id");
        $id = $req->get("id");
        $value = $req->get("value");
        $panier = PanierModel::where("user_id", $user_id)->get();

        $panier[0]->produits()->updateExistingPivot($id, ["quantite" => $value]);
    }

    public function remove(Request $req)
    {
        $id = $req->get("id");
        $panier = $req->get("panier");
        $panier = PanierModel::find($panier);

        $panier->produits()->detach($id);
    }

}
