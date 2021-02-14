<?php

namespace Database\Factories;

use App\Models\UsersModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
class UsersModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UsersModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           "nomUser"=>$this->faker->firstName,
           "prenomUser"=>$this->faker->lastName,
           "email"=>$this->faker->mail,
           'tel'=>$this->faker->e164PhoneNumber,
           "role_id"=>random_int(2,3),
           'adresse'=>$this->faker->address,
            "login"=>$this->faker->firstName,
            'password' => Hash::make('password'),
        ];
    }
}
