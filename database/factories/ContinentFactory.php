<?php

namespace PrionDevelopment\Geography\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use PrionDevelopment\Geography\Models\Continent;

class ContinentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Continent::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
