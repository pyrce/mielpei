<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class clientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'nomUser' => "admin",
            'prenomUser' => "admin",
            'login'=>"admin",
            "role_id"=>1,
            'password' => Hash::make('password'),
        ]);
    }

}
