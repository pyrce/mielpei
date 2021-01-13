<?php

namespace Database\Factories;


use Illuminate\Database\Eloquent\Factories\Factory;

class CommandeClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
           "user_id"=>random_int(1,3),
           "commande_id"=>random_int(1,5),
           "prix"=>$this->faker->numerify("##"),
           "quantite"=>$this->faker->numerify("##"),
        ];
    }
}
