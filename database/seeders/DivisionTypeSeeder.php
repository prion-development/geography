<?php

namespace PrionDevelopment\Database\Seeders;

use Illuminate\Database\Seeder;
use PrionDevelopment\Geography\Models\DivisionType;

class DivisionTypeSeeder extends Seeder
{
    /** @var string[] */
    protected $divisions = [
        'state',
        'territory',
        'country',
        'province'
    ];

    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->divisions as $continent) {
            DivisionType::firstOrUpdate([
                'name' => $continent
            ]);
        }
    }
}