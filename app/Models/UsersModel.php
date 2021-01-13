<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class UsersModel extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'users';
    public function commandes(){
        return $this->hasMany(CommandesModel::class,"user_id","id");
    
}
public function produits(){
    return $this->belongsToMany(ProduitsModel::class,"produit_user","produit_id","user_id")->withPivot("stock","prix");
}
public function roles(){
    return $this->belongsTo(RolesModel::class,"role_id","id");
}

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}