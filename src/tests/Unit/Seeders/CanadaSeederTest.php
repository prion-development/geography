<?php

namespace PrionDevelopment\Geography\tests\Unit\Seeders;

use PrionDevelopment\Database\Seeders\Countries\CanadaSeeder;
use PrionDevelopment\Database\Seeders\Countries\UnitedStatesSeeder;
use PrionDevelopment\Geography\Models\Continent;
use PrionDevelopment\Geography\Models\Country;
use PrionDevelopment\Geography\tests\GeographyBaseTest;

class CanadaSeederTest extends GeographyBaseTest
{
    protected $country = 'Canada';

    /** @test */
    public function will_process_seeder()
    {
        $this->artisan('db:seed', ['--class' => CanadaSeeder::class]);
        $total = (int) Continent::count();
        $this->assertEquals(1, $total);

        $this->assertEquals($this->country, Country::limit(1)->first()->name);

        Continent::truncate();
    }

    /** @test */
    public function will_have_divisions()
    {
        $this->artisan('db:seed', ['--class' => CanadaSeeder::class]);

        $seederDivisions = app(CanadaSeeder::class)->divisions();
        $this->assertArrayHasKey("territory", $seederDivisions);
        $country = Country::limit(1)->first();

        foreach ($seederDivisions as $divisionName => $division) {
            foreach ($division as $individual) {
                $this->assertDatabaseHas('divisions', [
                    'name' => $individual['name'],
                    'abbreviation' => $individual['abbr'],
                    'country_id' => $country->id,
                ]);
            }
        }
    }

    /**
     * @test
     */
    public function all_divisions_in_db()
    {
        $this->artisan('db:seed', ['--class' => CanadaSeeder::class]);

        $seederDivisions = app(CanadaSeeder::class)->divisions();
        $territoryCount = count($seederDivisions['territory']);

        $this->assertDatabaseCount('divisions', $territoryCount);
    }
}
