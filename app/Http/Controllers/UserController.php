<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
class UserController extends Controller
{
    //
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'nom' => 'required|string|between:2,100',
            'prenom' => 'required|string|between:2,100',
            'email' =>'required|string',
            'login' => 'required|string|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6',
        ]);

        
        $user=new User();
        $user->nomUser=$request["nom"];
        $user->prenomUser=$request["prenom"];
        $user->login=$request["login"];
        $user->role_id=$request["role_id"];
        $user->password=bcrypt( $request["password"]);
        $user->email=$request["email"];
        $user->save();
        return redirect("/");
    }
}
