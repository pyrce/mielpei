<?php

namespace Database\Factories;

use App\Models\ProduitsModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProduitsModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProduitsModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "nomProduit"=>$this->faker->name,
        ];
    }
}
