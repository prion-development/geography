<?php

namespace PrionDevelopment\Database\Seeders\Countries;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PrionDevelopment\Geography\Models\Continent;
use PrionDevelopment\Geography\Models\Country;
use PrionDevelopment\Geography\Models\Division;
use PrionDevelopment\Geography\Models\DivisionType;
use PrionDevelopment\Geography\Models\RegionType;

abstract class CountryBaseSeeder extends Seeder
{

    public function continent(): Continent
    {
        return Continent::firstOrCreate([
            'name' => $this->continent
        ]);
    }

    public function divisionType(string $type): DivisionType
    {
        $type = strtolower($type);
        return DivisionType::firstOrCreate([
            'name' => $type
        ]);
    }

    public function division(string $type, array $division): Division
    {
        $type = strtolower($type);
        return Division::firstOrCreate([
            'name' => $division['name'],
            'abbreviation' => $division['abbr'],
            'slug' => Str::slug($division['name']),
            'division_type_id' => $this->divisionType($type)->id,
            'country_id' => $this->country->id,
        ]);
    }
}