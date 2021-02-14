<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduitsController;
use App\Http\Controllers\ProducteursController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\CommandesController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\AuthController;
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
Route::middleware("auth")->get(
    '/producteur',
    [ProducteursController::class, 'index']
)->name("producteur");


Route::get(
    '/producteur/{id}',
    [ProducteursController::class, 'infos']
);
Route::put(
    '/producteur',
    [ProducteursController::class, 'modifier']
);

//----------------------------------Panier
Route::middleware("auth")->get(
    '/panier',
    [PanierController::class, 'index']
);
Route::get(
    '/panier/listeadresse',
    [PanierController::class, 'listeAdresse']
);
Route::post(
    '/panier',
    [PanierController::class, 'add']
);
Route::put(
    '/panier',
    [PanierController::class, 'updateqte']
);
Route::delete(
    '/panier',
    [PanierController::class, 'delete']
);
Route::delete(
    '/panier/remove',
    [PanierController::class, 'remove']
);
Route::get(
    '/commandes',
    [CommandesController::class, 'index']
);

Route::get(
    '/commandes/{id}',
    [CommandesController::class, 'show']
);
Route::get(
    '/commandes/pdf/{id}',
    [CommandesController::class, 'topdf']
);

Route::get(
    '/admin',
    [AdminController::class, 'show']
);
Route::put(
    '/admin',
    [AdminController::class, 'changerole']
);
Route::post(
    '/admin',
    [AdminController::class, 'adduser']
);
Route::get(
    '/admin/desactiver/{id}',
    [AdminController::class, 'suspend']
);
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
