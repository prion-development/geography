<?php

namespace PrionDevelopment\database\seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PrionDevelopment\Geography\Models\Continent;

class ContinentSeeder extends Seeder
{
    protected $continents = [
        'North America',
        'South America',
        'Europe',
        'Asia',
        'Africa',
        'Oceania',
        'Antartica'
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