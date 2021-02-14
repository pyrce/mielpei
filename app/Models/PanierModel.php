<?php

namespace App\Models;

use App\Http\Resources\ProduitsResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanierModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'panier';
    protected $fillable = [
        'user_id'
       ];
    public function produits(){
        return $this->belongsToMany(ProduitsModel::class,"panier_produit","panier_id","produit_id")->withPivot("user_id","prix","quantite","stock");
    }
}
