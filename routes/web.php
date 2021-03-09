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

Route::middleware("auth")->post(
    '/producteurs',
    [ProducteursController::class, 'ajout']
);
Route::middleware("auth")->delete(
    '/producteurs',
    [ProducteursController::class, 'deleteProduit']
);
Route::middleware("auth")->put(
    '/producteurs/stock',
    [ProducteursController::class, 'addstock']
);
Route::get(
    '/producteurs/{id}',
    [ProducteursController::class, 'show']
);
Route::middleware(["auth"])->get(
    '/producteur',
    [ProducteursController::class, 'index']
)->name("producteur");


Route::middleware("auth")->get(
    '/producteur/{id}',
    [ProducteursController::class, 'infos']
);
Route::middleware("auth")->put(
    '/producteur',
    [ProducteursController::class, 'modifier']
);

//----------------------------------Panier
Route::middleware("auth")->get(
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
Route::middleware("auth")->post(
    '/panier',
    [PanierController::class, 'add']
);
Route::middleware("auth")->put(
    '/panier',
    [PanierController::class, 'updateqte']
);
Route::middleware("auth")->post(
    '/panier/paiement',
    [PanierController::class, 'paiement']
);
Route::middleware("auth")->delete(
    '/panier/remove',
    [PanierController::class, 'remove']
);
Route::middleware("auth")->get(
    '/commandes',
    [CommandesController::class, 'index']
);

Route::middleware("auth")->get(
    '/commandes/{id}',
    [CommandesController::class, 'show']
);
Route::middleware("auth")->get(
    '/commandes/pdf/{id}',
    [CommandesController::class, 'topdf']
);

Route::middleware("auth")->get(
    '/admin',
    [AdminController::class, 'show']
);
Route::middleware("auth")->put(
    '/admin',
    [AdminController::class, 'changerole']
);
Route::middleware("auth")->post(
    '/admin',
    [AdminController::class, 'adduser']
);
Route::middleware("auth")->get(
    '/admin/desactiver/{id}',
    [AdminController::class, 'suspend']
);
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
