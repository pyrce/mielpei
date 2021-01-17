<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ProduitProducteurSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        for($i=0;$i<30;$i++){
        DB::table('produit_user')->insert([
            'produit_id' => rand(1,30),
            'user_id' =>rand(2,5),
            'prix' =>rand(8,20),
            'stock'=>rand(40,100)
        ]);
        }

    }
}
