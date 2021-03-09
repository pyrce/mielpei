<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommandesModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'commandes';
    protected $fillable = [
        'user_id',"date","addresse","addresse_livraison","addresse_facturation"
       ];
    public function clients(){
        return $this->belongsTo(UsersModel::class);
    }

    public function produits(){
        return $this->belongsToMany(ProduitsModel::class,"commande_produit","commande_id","produit_id")->withPivot("id","commande_id","prix","quantite");
      // return $this->belongsToMany(ProduitsModel::class)->using("commande_produit")->withPivot("id","commande_id","client_id","prix","quantite");
    }
}
