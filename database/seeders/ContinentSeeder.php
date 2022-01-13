<?php

namespace PrionDevelopment\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PrionDevelopment\Geography\Models\Continent;

class ContinentSeeder extends Seeder
{
    protected $continents = [
        'Africa',
        'Antartica',
        'Asia',
        'Europe',
        'North America',
        'Oceania',
        'South America',
    ];

    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->continents as $continent) {
            Continent::updateOrCreate([
                'name' => $continent
            ]);
        }
    }
}