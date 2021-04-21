<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProduitsModel extends Model
{
    use HasFactory;
    protected $table = 'produits';
    public $timestamps = false;
    public function users(){
        return $this->belongsToMany(User::class,"produit_user","produit_id","user_id")->withPivot("stock","prix","user_id","totalvente");
    }

    public function paniers(){
        return $this->belongsToMany(PanierModel::class,"panier_produit","panier_id","user_id")->withPivot("panier_id","user_id","prix","quantite","stock");
    }

    public function commandes(){
        return $this->belongsToMany(CommandesModel::class,"commande_produit","commande_id","produit_id")->withPivot("id","commande_id","prix","quantite");
       // return $this->belongsToMany(CommandesModel::class)->using("commande_produit")->withPivot("id","commande_id","client_id","prix","quantite");
    }
}
