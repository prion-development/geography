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

class IrelandSeeder extends Seeder
{
    protected $name = 'Ireland';
    protected $nameFull = 'Republic of Ireland';

    /** @var Country */
    protected $country;

    protected $iso = 'IE';
    protected $isoLong = 'IRL';
    protected $isoNumeric = '372';

    protected $continent = 'Europe';
    protected $capital = 'Dublin';

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
                'symbol' => '€',
                'symbol_html' => '',
                'name' => 'Euro',
                'abbr' => 'EUR',
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
                'LEN' => [
                    'name' => 'Leinster',
                    'abbr' => 'LEN',
                    'region' => '',
                    'capital' => 'Dublin',
                ],
                'UIE' => [
                    'name' => 'Ulster',
                    'abbr' => 'UIE',
                    'region' => '',
                    'capital' => 'Belfast',
                ],
                'MUN' => [
                    'name' => 'Munster',
                    'abbr' => 'MUN',
                    'region' => '',
                    'capital' => 'Cork',
                ],
                'CON' => [
                    'name' => 'Connacht',
                    'abbr' => 'CON',
                    'region' => '',
                    'capital' => 'Galway',
                ],
            ],
        ];
    }
}