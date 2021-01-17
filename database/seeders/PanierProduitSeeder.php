<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class PanierProduitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('panier_produit')->insert([
            'panier_id' =>1,
            "produit_id"=>1,
            "quantite"=>2,
            "user_id"=>3,
            "stock"=>10,
            "prix"=>10
        ]);

        DB::table('panier_produit')->insert([
            'panier_id' =>1,
            "produit_id"=>2,
            "quantite"=>5,
            "user_id"=>3,
            "stock"=>10,
            "prix"=>10
        ]);
    }
}
