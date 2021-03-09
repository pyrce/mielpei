<?php

namespace Database\Factories;

use App\Models\CommandesModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommandesModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CommandesModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "date"=>$this->faker->date,
            "user_id"=>random_int(2,5),
            "addresse_facturation"=>$this->faker->address,
            "addresse_livraison"=>$this->faker->address
        ];
    }
}
