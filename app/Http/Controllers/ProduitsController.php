<?php

namespace App\Http\Controllers;

use App\Models\CommandesModel;
use App\Models\ProducteursModel;
use Illuminate\Http\Request;
use App\Models\ProduitsModel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProduitsController extends Controller
{
    //
    public function __construct()
    {
        // $this->middleware('auth');
    }

    public function index()
    {
      
        $produits = ProduitsModel::join('produit_user', 'produit_id', '=', "produits.id")
            ->join("users", "user_id", "=", "users.id")->where("role_id", 2)->paginate(10);

      // $ventes = CommandesModel::select("id", CommandesModel::raw("COUNT(*)"))->with("produits","users","commande_produit")->groupBy("commande_produit.produit_id","user_id")->limit(5)->get();
$ventes=ProduitsModel::join("produit_user","produits.id","=","produit_id")->where("stock",">","0")->orderBy("totalvente","desc")->limit(5)->get();

        return view("welcome", ["produits" => $produits, "ventes" => $ventes]);
    }
}
