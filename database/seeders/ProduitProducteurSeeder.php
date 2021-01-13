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
        DB::table('produit_user')->insert([
            'produit_id' => 5,
            'user_id' =>2,
            'prix' =>rand(8,20),
            'stock'=>rand(40,100)
        ]);

        DB::table('produit_user')->insert([
            'produit_id' => 2,
            'user_id' =>2,
            'prix' =>rand(8,20),
            'stock'=>rand(40,100)
        ]);
        DB::table('produit_user')->insert([
            'produit_id' => 3,
            'user_id' =>2,
            'prix' =>rand(8,20),
            'stock'=>rand(40,100)
        ]);
        DB::table('produit_user')->insert([
            'produit_id' => 12,
            'user_id' =>3,
            'prix' =>rand(8,20),
            'stock'=>rand(40,100)
        ]);
        DB::table('produit_user')->insert([
            'produit_id' => 15,
            'user_id' =>3,
            'prix' =>rand(8,20),
            'stock'=>rand(40,100)
        ]);
        DB::table('produit_user')->insert([
            'produit_id' => 7,
            'user_id' =>3,
            'prix' =>rand(8,20),
            'stock'=>rand(40,100)
        ]);

        DB::table('produit_user')->insert([
            'produit_id' => 17,
            'user_id' =>3,
            'prix' =>rand(8,20),
            'stock'=>rand(40,100)
        ]);
    }
}
