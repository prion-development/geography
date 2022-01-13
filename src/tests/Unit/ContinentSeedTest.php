<?php

namespace PrionDevelopment\Geography\tests\Unit;

use PrionDevelopment\Database\Seeders\ContinentSeeder;
use PrionDevelopment\Geography\Models\Continent;
use PrionDevelopment\Geography\tests\GeographyBaseTest;

class ContinentSeedTest extends GeographyBaseTest
{
    /** @test */
    public function will_seed_continents()
    {
        $this->artisan('db:seed', ['--class' => ContinentSeeder::class]);
        $total = (int) Continent::count();
        $this->assertEquals(7, $total);
        Continent::truncate();
    }

    /** @test */
    public function will_find_continent()
    {
        $continent = 'North America';
        $this->artisan('db:seed', ['--class' => ContinentSeeder::class]);
        $continentNa = Continent::getContinent($continent);
        $this->assertNotEmpty(optional($continentNa)->id);
        Continent::truncate();
    }

    /** @test */
    public function will_not_find_continent()
    {
        $continent = 'East America';
        $this->artisan('db:seed', ['--class' => ContinentSeeder::class]);
        $continentNa = Continent::getContinent($continent);
        $this->assertEmpty(optional($continentNa)->id);
        Continent::truncate();
    }

}
