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

class GreatBritianSeeder extends CountryBaseSeeder
{
    protected $name = 'United Kingdom';
    protected $nameFull = 'The United Kingdom of Great Britain and Northern Ireland';

    /** @var Country */
    protected $country;

    protected $iso = 'GB';
    protected $isoLong = 'GBR';
    protected $isoNumeric = '826';

    protected $continent = 'Europe';
    protected $capital = 'London';

    protected $language = 'English';

    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $this->country = Country::firstOrCreate([
            'iso' => $this->iso,
        ], [
            'name' => $this->name,
            'name_full' => $this->nameFull,
            'slug' => strtolower($this->iso),
            'iso_long' => $this->isoLong,
            'iso_numeric' => $this->isoNumeric,
            'continent_id' => $this->continent()->id,
        ]);

        foreach ($this->divisions() as $divisionType => $divisions) {
            foreach ($divisions as $division) {
                $this->division($divisionType, $division);
            }
        }
    }

    /**
     * All Country Currencies
     *
     * @return array[]
     */
    public function currencies(): array
    {
        return [
            [
                'symbol' => '£',
                'symbol_html' => '',
                'name' => 'Great Britain Pound',
                'abbr' => 'GBP',
                'primary' => true
            ]
        ];
    }

    /**
     * All Country Langugages
     *
     * @return string[]
     */
    public function languages(): array
    {
        return [
            'English',
        ];
    }

    public function divisions(): array
    {
        return [
            'country' => [
                'ENG' => [
                    'name' => 'England',
                    'abbr' => 'ENG',
                    'region' => '',
                    'capital' => '',
                ],
                'SCT' => [
                    'name' => 'Scotland',
                    'abbr' => 'SCT',
                    'region' => '',
                    'capital' => '',
                ],
                'WAL' => [
                    'name' => 'Wales',
                    'abbr' => 'WAL',
                    'region' => '',
                    'capital' => '',
                ],
                'NIR' => [
                    'name' => 'Northern Ireland',
                    'abbr' => 'NIR',
                    'region' => '',
                    'capital' => '',
                ],
            ],
        ];
    }
}
