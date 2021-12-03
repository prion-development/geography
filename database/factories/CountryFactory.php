<?php

namespace PrionDevelopment\Geography\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use PrionDevelopment\Geography\Models\Country;

class CountryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Country::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'iso' => $this->faker->text(2),
            'iso_long' => $this->faker->text(3),
            'iso_numeric' => $this->faker->numberBetween(100,999),
            'continent_id' => Country::factory()->create()->id,
        ];
    }
}
