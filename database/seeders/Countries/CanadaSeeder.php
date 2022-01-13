<?php

namespace Database\Seeders\Countries;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PrionDevelopment\Geography\Models\Continent;
use PrionDevelopment\Geography\Models\Country;
use PrionDevelopment\Geography\Models\Division;
use PrionDevelopment\Geography\Models\DivisionType;
use PrionDevelopment\Geography\Models\RegionType;

class CanadaSeeder extends Seeder
{
    protected $name = 'Canada';
    protected $nameFull = 'Canada';

    /** @var Country */
    protected $country;

    protected $iso = 'CA';
    protected $isoLong = 'CAN';
    protected $isoNumeric = '124';

    protected $continent = 'North America';
    protected $capital = 'Ottawa';

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
            'division_type_id' => $this->divisionType($type)->id,
            'country_id' => $this->country->id,
        ]);
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
                'symbol' => '$',
                'symbol_html' => '',
                'name' => 'Canadian Dollar',
                'abbr' => 'CAD',
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
            'Portuguese',
            'French',
        ];
    }

    public function divisions(): array
    {
        return [
            'territory' => [
                'ON' => [
                    'name' => 'Ontario',
                    'abbr' => 'ON',
                    'region' => '',
                    'capital' => 'Toronto',
                ],
                'QC' => [
                    'name' => 'Quebec',
                    'abbr' => 'QC',
                    'region' => '',
                    'capital' => 'Quebec City',
                ],
                'NS' => [
                    'name' => 'Nova Scotia',
                    'abbr' => 'NS',
                    'region' => '',
                    'capital' => 'Halifax',
                ],
                'NB' => [
                    'name' => 'New Brunswick',
                    'abbr' => 'NB',
                    'region' => '',
                    'capital' => 'Fredericton',
                ],
                'MB' => [
                    'name' => 'Manitoba',
                    'abbr' => 'MB',
                    'region' => '',
                    'capital' => 'Winnipeg',
                ],
                'BC' => [
                    'name' => 'British Columbia',
                    'abbr' => 'BC',
                    'region' => '',
                    'capital' => 'Victoria',
                ],
                'PE' => [
                    'name' => 'Prince Edward Island',
                    'abbr' => 'PE',
                    'region' => '',
                    'capital' => 'Charlottetown',
                ],
                'SK' => [
                    'name' => 'Saskatchewan',
                    'abbr' => 'SK',
                    'region' => '',
                    'capital' => 'Regina',
                ],
                'AB' => [
                    'name' => 'Alberta',
                    'abbr' => 'AB',
                    'region' => '',
                    'capital' => 'Edmonton',
                ],
                'NL' => [
                    'name' => 'Newfoundland and Labrador',
                    'abbr' => 'NL',
                    'region' => '',
                    'capital' => 'St. John\'s',
                ],
            ],
        ];
    }
}
