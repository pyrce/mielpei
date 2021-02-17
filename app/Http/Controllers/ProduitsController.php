<?php

namespace App\Http\Controllers;

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

        $ventes = ProduitsModel::select("id", ProduitsModel::raw("COUNT(*)"), "nomProduit")->with("commandes")->groupBy("produits.id")->limit(5)->get();


        return view("welcome", ["produits" => $produits, "ventes" => $ventes]);
    }
}
