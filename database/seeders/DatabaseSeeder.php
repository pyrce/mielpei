<?php

namespace Database\Seeders;

use App\Models\UsersModel;
use App\Models\CommandesModel;
use App\Models\AdresseFacturation;
use App\Models\AdresseLivraison;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\ProduitsModel;
use App\Models\ProducteursModel;
use Facade\FlareClient\Http\Client;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       //  \App\Models\ClientsModel::factory(10)->create();

    //ProduitsModel::factory()->times(60)->create();
    CommandesModel::factory()->times(30)->create();
    AdresseFacturation::factory()->times(30)->create();
    AdresseLivraison::factory()->times(30)->create();
    //UsersModel::factory()->times(10)->create();

   // $produits = ProduitsModel::all();

    $this->call([
        ProduitsSeeder::class,
        clientsSeeder::class,
        ProduitProducteurSeeder::class,
        PanierSeeder::class,
        PanierProduitSeeder::class,
        CommandeClientSeeder::class,
        RolesSeeder::class
    ]);
// Populate the pivot table
/*ProducteursModel::all()->each(function ($user) use ($produits) { 
    $user->produits()->attach(
        $produits->random(rand(1, 5))->pluck('id')->toArray()
    ); 
});*/



    }
}
