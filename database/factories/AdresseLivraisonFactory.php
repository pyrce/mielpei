<?php

namespace Database\Factories;

use App\Models\AdresseLivraison;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdresseLivraisonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AdresseLivraison::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "voie"=>random_int(1,30),
            "commande_id"=>random_int(1,30),
            "rue"=>$this->faker->address,
            "ville"=>$this->faker->state,
            "pays"=>$this->faker->country
         ];
    }
}
