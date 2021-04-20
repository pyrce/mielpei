<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitsController;
use App\Http\Controllers\ProducteursController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\CommandesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\EnsureTokenIsValid;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
    Route::get(
        '/',
        [ProduitsController::class, 'index']
    )->name("index");

Route::group([

  // 'middleware' => 'auth:web',
   // "prefix"=>"auth"

], function ($router) {

    Route::post('login', [AuthController::class,"login"])->name("login");
    Route::post('register', [UserController::class,"register"])->name("register");
    Route::get('logout', [AuthController::class,"logout"]);
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});


Route::get(
    '/login',
function(){
    $token = auth()->user();
return view("login");
}
);

Route::get(
    '/register',
function(){
    $token = auth()->user();
return view("register");
}
);
//-----------------------------------------------------------Producteurs
Route::middleware("role:producteur")->post(
    '/producteurs',
    [ProducteursController::class, 'ajout']
);
Route::middleware("role:producteur")->delete(
    '/producteurs',
    [ProducteursController::class, 'deleteProduit']
);
Route::middleware("role:producteur")->put(
    '/producteurs/stock',
    [ProducteursController::class, 'addstock']
);

Route::middleware("auth")->get(
    '/producteurs/commandes/{id}',
    [ProducteursController::class, 'showcommandes']
);

Route::get(
    '/producteurs/{id}',
    [ProducteursController::class, 'show']
);
Route::middleware(["role:producteur"])->get(
    '/producteur',
    [ProducteursController::class, 'index']
)->name("producteur");

Route::get(
    '/producteur/mesproduits',
    [ProducteursController::class, 'MesProduits']
);

Route::get(
    '/producteur/commandes',
    [ProducteursController::class, 'commandes']
);
Route::middleware("role:producteur")->get(
    '/producteur/{id}',
    [ProducteursController::class, 'infos']
);
Route::middleware("role:producteur")->put(
    '/producteur',
    [ProducteursController::class, 'modifier']
);

//-----------------------------------------------------------Panier
Route::get(
    '/panier',
    [PanierController::class, 'index']
);
Route::get(
    '/panier/listeadresselivraion',
    [PanierController::class, 'listeAdresseLivraion']
);
Route::get(
    '/panier/listeadressefacturation',
    [PanierController::class, 'listeAdresseFacturation']
);
Route::post(
    '/panier',
    [PanierController::class, 'add']
);
Route::put(
    '/panier',
    [PanierController::class, 'updateqte']
);
Route::post(
    '/panier/paiement',
    [PanierController::class, 'paiement']
);
Route::delete(
    '/panier/remove',
    [PanierController::class, 'remove']
);
Route::get(
    '/macommande',
    function(){ return view("macommande");}
);


//-----------------------------------------------------------Commandes
Route::middleware("auth")->get(
    '/commandes',
    [CommandesController::class, 'index']
);

Route::middleware("auth")->get(
    '/commandes/{id}',
    [CommandesController::class, 'show']
);



Route::get(
    '/commandes/pdf/{id}',
    [CommandesController::class, 'topdf']
);

//-----------------------------------------------------------Admin
Route::middleware("role:admin")->get(
    '/admin',
    [AdminController::class, 'show']
);
Route::middleware("role:admin")->put(
    '/admin',
    [AdminController::class, 'changerole']
);
Route::middleware("role:admin")->post(
    '/admin',
    [AdminController::class, 'adduser']
);
Route::middleware("role:admin")->get(
    '/admin/desactiver/{id}',
    [AdminController::class, 'suspend']
);
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
