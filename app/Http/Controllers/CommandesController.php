<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\CommandesModel;
use App\Models\User;
use App\Post;
use PDF;

class CommandesController extends Controller
{
    public function index()
    {

        $commandes = CommandesModel::with("produits")->where("user_id", "=", Auth::user()->id)->get();
        $total = [];
        foreach ($commandes as $c) {

            $total[$c->id] = 0;

            $somme = 0;
            foreach ($c->produits as $p) {
                // print_r( $c);

                $somme += $p->pivot->prix * $p->pivot->quantite;

                $total[$c->id] = $somme;
            }
        }

        return view("commandes", ["commandes" => $commandes, "total" => $total]);
    }

    public function show(Request $req, $id)
    {

        $commande = CommandesModel::with("produits")->where("id", "=", $id)->get();

        return view("detail_commande", ["commande" => $commande[0]]);
    }

    public function topdf($id)
    {

        $commande = CommandesModel::with("produits")->where("id", "=", $id)->get();
        $user = User::find(Auth::user()["id"]);
        $total = [];
        foreach ($commande as $c) {

            $total[$c->id] = 0;

            $somme = 0;
            foreach ($c->produits as $p) {


                $somme += $p->pivot->prix * $p->pivot->quantite;

                $total[$c->id] = $somme;
            }
        }

        return PDF::loadView('pdf', ["user" => $user, "total" => $total[$commande[0]["id"]], "commande" => $commande[0]])
            ->setPaper('a4', 'landscape')
            ->setWarnings(false)

            ->stream();
    }
}
