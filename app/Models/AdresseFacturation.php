<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdresseFacturation extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'adresse_facturation';
    protected $fillable = [
        "commande_id","voie","rue","ville","pays"
       ];

       public function commandes(){
           return $this->belongTo(CommandesModel::class);
       }
}
