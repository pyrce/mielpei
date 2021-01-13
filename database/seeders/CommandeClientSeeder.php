<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class CommandeClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('commande_produit')->insert([
            'commande_id' => 1,
            'produit_id' =>rand(1,3),
            "user_id"=>1,
            'prix' =>rand(5,10),
            'quantite' =>rand(1,5),
        ]);

        DB::table('commande_produit')->insert([
            'commande_id' => 1,
            'produit_id' =>rand(1,3),
            "user_id"=>1,
            'prix' =>rand(5,10),
            'quantite' =>rand(1,5),
        ]);

        DB::table('commande_produit')->insert([
            'commande_id' => 1,
            'produit_id' =>rand(1,3),
            "user_id"=>1,
            'prix' =>rand(5,10),
            'quantite' =>rand(1,5),
        ]);

        DB::table('commande_produit')->insert([
            'commande_id' => 1,
            'produit_id' =>rand(1,3),
            "user_id"=>1,
            'prix' =>rand(5,10),
            'quantite' =>rand(1,5),
        ]);
    }
}
