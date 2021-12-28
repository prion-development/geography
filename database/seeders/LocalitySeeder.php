<?php

namespace PrionDevelopment\Database\Seeders;

use Illuminate\Database\Seeder;
use PrionDevelopment\Geography\Models\DivisionType;
use PrionDevelopment\Geography\Models\LocalityType;

class LocalitySeeder extends Seeder
{
    /** @var string[] */
    protected $localities = [
        'city',
        'town',
    ];

    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->localities as $locality) {
            LocalityType::firstOrCreate([
                'name' => $locality
            ]);
        }
    }
}
