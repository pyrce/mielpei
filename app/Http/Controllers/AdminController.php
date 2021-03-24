<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RolesModel;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    //
    public function __construct()
    {
       // $this->authorizeResource(User::class, 'admin');
    }

    public function show()
    {
 
            $users = User::all();
            $roles = RolesModel::all();

            return view("admin", ["users" => $users, "roles" => $roles]);

    }

    public function changerole(Request $req)
    {
        $data = $req->all();

        User::where("id", $data["userid"])->update([$data["champ"] => $data["value"]]);
        // $user=User::find($data["userid"]);
        // $user->role_id=$data["value"];
        // $user->save();
    }

    public function adduser(Request $req)
    {
        $data = $req->all();

        $user = new User();
        $user->role_id = $data["role"];
        $user->nomUser = $data["nomUser"];
        $user->prenomUser = $data["prenomUser"];
        $user->login = $data["nomUser"];
        $user->password = bcrypt("password");
        $user->save();
        return redirect("/admin");
    }

    public function suspend($id)
    {

        $user = User::find($id);
        $user->etat = $user["etat"] == 1 ? 0 : 1;
        $user->save();
        return redirect("/admin");
    }
}
