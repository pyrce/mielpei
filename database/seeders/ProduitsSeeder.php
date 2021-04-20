<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ProduitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=1;$i<60;$i++){
            DB::table('produits')->insert([
                'nomProduit' => "miel ".$i,
            ]);
        }
    }
}
