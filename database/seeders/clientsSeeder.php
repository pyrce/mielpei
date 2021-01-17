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

        DB::table('users')->insert([
            'nomUser' => "paul",
            'prenomUser' => "doe",
            'login'=>"paul",
            "role_id"=>2,
            'password' => Hash::make('password'),
        ]);
        DB::table('users')->insert([
            'nomUser' => "dell",
            'prenomUser' => "doe",
            'login'=>"dell",
            "role_id"=>2,
            'password' => Hash::make('password'),
        ]);
        DB::table('users')->insert([
            'nomUser' => "diane",
            'prenomUser' => "doe",
            'login'=>"diane",
            "role_id"=>2,
            'password' => Hash::make('password'),
        ]);
        DB::table('users')->insert([
            'nomUser' => "leon",
            'prenomUser' => "doe",
            'login'=>"leon",
            "role_id"=>2,
            'password' => Hash::make('password'),
        ]);

        DB::table('users')->insert([
            'nomUser' => "toto",
            'prenomUser' => "test",
            'login'=>"toto",
            "role_id"=>3,
            'password' => Hash::make('password'),
        ]);
    }

}
