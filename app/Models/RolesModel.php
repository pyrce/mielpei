<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolesModel extends Model
{
    use HasFactory;
    protected $table = 'roles';
    public $timestamps = false;

    function users(){
        return $this->hasMany(UsersModel::class,"role_id","id");
    }
}
