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

    public function index(){


    
    // dd($user);

        $produits = ProduitsModel::join('produit_user','produit_id','=',"produits.id")
        ->join("users","user_id","=","users.id")->where("role_id",2)->where("etat",1)->paginate(10);

        return view("welcome",["produits"=>$produits]);

    }

}
