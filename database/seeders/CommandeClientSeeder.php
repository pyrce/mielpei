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

        for($i=0;$i<40;$i++){
        DB::table('commande_produit')->insert([
            'commande_id' => random_int(1,5),
            'produit_id' =>rand(1,3),
            "user_id"=>random_int(2,5),
            'prix' =>rand(5,10),
            'quantite' =>rand(1,5),
        ]);
        }

    }
}
