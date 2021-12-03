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

class UnitedStatesSeeder extends Seeder
{
    protected $name = 'United States';
    protected $nameFull = 'United States of America';

    /** @var Country */
    protected $country;

    protected $iso = 'US';
    protected $isoLong = 'USA';
    protected $isoNumeric = '840';

    protected $continent = 'North America';
    protected $capital = 'Washington DC';

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
                'symbol' => '$',
                'symbol_html' => '',
                'name' => 'US Dollar',
                'abbr' => 'USD',
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
            'Spanish',
        ];
    }

    public function divisions(): array
    {
        return [
            'state' => [
                'AL' => [
                    'name' => 'Alabama',
                    'abbr' => 'AL',
                    'region' => 'South',
                    'capital' => 'Montgomery',
                ],
                'AK' => [
                    'name' => 'Alaska',
                    'abbr' => 'AK',
                    'region' => 'Northwest',
                    'capital' => 'Juneau',
                ],
                'AZ' => [
                    'name' => 'Arizona',
                    'abbr' => 'AZ',
                    'region' => 'Southwest',
                    'capital' => 'Phoenix',
                ],
                'AR' => [
                    'name' => 'Arkansas',
                    'abbr' => 'AR',
                    'region' => 'South',
                    'capital' => 'Little Rock',
                ],
                'CA' => [
                    'name' => 'California',
                    'abbr' => 'CA',
                    'region' => 'Southwest',
                    'capital' => 'Sacramento',
                ],
                'CO' => [
                    'name' => 'Colorado',
                    'abbr' => 'CO',
                    'region' => 'West',
                    'capital' => 'Denver',
                ],
                'CT' => [
                    'name' => 'Connecticut',
                    'abbr' => 'CT',
                    'region' => 'Northeast',
                    'capital' => 'Hartford',
                ],
                'DE' => [
                    'name' => 'Delaware',
                    'abbr' => 'DE',
                    'region' => 'Northeast',
                    'capital' => 'Dover',
                ],
                'FL' => [
                    'name' => 'Florida',
                    'abbr' => 'FL',
                    'region' => 'South',
                    'capital' => 'Tallahassee',
                ],
                'GA' => [
                    'name' => 'Georgia',
                    'abbr' => 'GA',
                    'region' => 'South',
                    'capital' => 'Atlanta',
                ],
                'HI' => [
                    'name' => 'Hawaii',
                    'abbr' => 'HI',
                    'region' => 'West',
                    'capital' => 'Honolulu',
                ],
                'ID' => [
                    'name' => 'Idaho',
                    'abbr' => 'ID',
                    'region' => 'West',
                    'capital' => 'Boise',
                ],
                'IL' => [
                    'name' => 'Illinois',
                    'abbr' => 'IL',
                    'region' => 'Midwest',
                    'capital' => 'Springfield',
                ],
                'IN' => [
                    'name' => 'Indiana',
                    'abbr' => 'IN',
                    'region' => 'Midwest',
                    'capital' => 'Indianapolis',
                ],
                'IA' => [
                    'name' => 'Iowa',
                    'abbr' => 'IA',
                    'region' => 'Midwest',
                    'capital' => 'Des Moines',
                ],
                'KS' => [
                    'name' => 'Kansas',
                    'abbr' => 'KS',
                    'region' => 'Midwest',
                    'capital' => 'Topeka',
                ],
                'KY' => [
                    'name' => 'Kentucky',
                    'abbr' => 'KT',
                    'region' => 'Midwest',
                    'capital' => 'Frankfort',
                ],
                'LA' => [
                    'name' => 'Louisiana',
                    'abbr' => 'LA',
                    'region' => 'South',
                    'capital' => 'Baton Rouge',
                ],
                'ME' => [
                    'name' => 'Maine',
                    'abbr' => 'ME',
                    'region' => 'Northeast',
                    'capital' => 'Augusta',
                ],
                'MD' => [
                    'name' => 'Maryland',
                    'abbr' => 'MD',
                    'region' => 'Maryland',
                    'capital' => 'Annapolis',
                ],
                'MA' => [
                    'name' => 'Massachusetts',
                    'abbr' => 'MA',
                    'region' => 'Northwest',
                    'capital' => 'Boston',
                ],
                'MI' => [
                    'name' => 'Michigan',
                    'abbr' => 'MI',
                    'region' => 'Midwest',
                    'capital' => 'Lansing',
                ],
                'MN' => [
                    'name' => 'Minnesota',
                    'abbr' => 'MN',
                    'region' => 'Midwest',
                    'capital' => 'Saint Paul',
                ],
                'MS' => [
                    'name' => 'Mississippi',
                    'abbr' => 'MS',
                    'region' => 'South',
                    'capital' => 'Jackson',
                ],
                'MO' => [
                    'name' => 'Missouri',
                    'abbr' => 'MO',
                    'region' => 'Midwest',
                    'capital' => 'Jefferson City',
                ],
                'MT' => [
                    'name' => 'Montana',
                    'abbr' => 'MT',
                    'region' => 'Northwest',
                    'capital' => 'Helena',
                ],
                'NE' => [
                    'name' => 'Nebraska',
                    'abbr' => 'NE',
                    'region' => 'Midwest',
                    'capital' => 'Lincoln',
                ],
                'NV' => [
                    'name' => 'Nevada',
                    'abbr' => 'NV',
                    'region' => 'Southwest',
                    'capital' => 'Carson City',
                ],
                'NH' => [
                    'name' => 'New Hampshire',
                    'abbr' => 'NH',
                    'region' => 'Northeast',
                    'capital' => 'Concord',
                ],
                'NJ' => [
                    'name' => 'New Jersey',
                    'abbr' => 'NJ',
                    'region' => 'Northeast',
                    'capital' => 'Trenton',
                ],
                'NM' => [
                    'name' => 'New Mexico',
                    'abbr' => 'NM',
                    'region' => 'Southwest',
                    'capital' => 'Santa Fe',
                ],
                'NY' => [
                    'name' => 'New York',
                    'abbr' => 'NY',
                    'region' => 'Northeast',
                    'capital' => 'Albany',
                ],
                'NC' => [
                    'name' => 'North Carolina',
                    'abbr' => 'NC',
                    'region' => 'South',
                    'capital' => 'Raleigh',
                ],
                'ND' => [
                    'name' => 'North Dakota',
                    'abbr' => 'ND',
                    'region' => 'Midwest',
                    'capital' => 'Bismarck',
                ],
                'OH' => [
                    'name' => 'Ohio',
                    'abbr' => 'OH',
                    'region' => 'Midwest',
                    'capital' => 'Columbus',
                ],
                'OK' => [
                    'name' => 'Oklahoma',
                    'abbr' => 'OK',
                    'region' => 'South',
                    'capital' => 'Oklahoma City',
                ],
                'OR' => [
                    'name' => 'Oregon',
                    'abbr' => 'OR',
                    'region' => 'Northwest',
                    'capital' => 'Salem',
                ],
                'PA' => [
                    'name' => 'Pennsylvania',
                    'abbr' => 'PA',
                    'region' => 'Northeast',
                    'capital' => 'Harrisburg',
                ],
                'RI' => [
                    'name' => 'Rhode Island',
                    'abbr' => 'IR',
                    'region' => 'Northeast',
                    'capital' => 'Providence',
                ],
                'SC' => [
                    'name' => 'South Carolina',
                    'abbr' => 'SC',
                    'region' => 'South',
                    'capital' => 'Columbia',
                ],
                'SD' => [
                    'name' => 'South Dakota',
                    'abbr' => 'SD',
                    'region' => 'Midwest',
                    'capital' => 'Pierre',
                ],
                'TN' => [
                    'name' => 'Tennessee',
                    'abbr' => 'TN',
                    'region' => 'South',
                    'capital' => 'Nashville',
                ],
                'TX' => [
                    'name' => 'Texas',
                    'abbr' => 'TX',
                    'region' => 'South',
                    'capital' => 'Austin',
                ],
                'UT' => [
                    'name' => 'Utah',
                    'abbr' => 'UT',
                    'region' => 'West',
                    'capital' => 'Salt Lake City',
                ],
                'VT' => [
                    'name' => 'Vermont',
                    'abbr' => 'VT',
                    'region' => 'Northeast',
                    'capital' => 'Montpelier',
                ],
                'VA' => [
                    'name' => 'Virginia',
                    'abbr' => 'VA',
                    'region' => 'Northeast',
                    'capital' => 'Richmond',
                ],
                'WA' => [
                    'name' => 'Washington',
                    'abbr' => 'WA',
                    'region' => 'Northwest',
                    'capital' => 'Olympia',
                ],
                'WV' => [
                    'name' => 'West Virginia',
                    'abbr' => 'WV',
                    'region' => 'Northeast',
                    'capital' => 'Charleston',
                ],
                'WI' => [
                    'name' => 'Wisconsin',
                    'abbr' => 'WI',
                    'region' => 'Midwest',
                    'capital' => 'Madison',
                ],
                'WY' => [
                    'name' => 'Wyoming',
                    'abbr' => 'WY',
                    'region' => 'West',
                    'capital' => 'Cheyenne',
                ],
            ],

            'territory' => [
                'AS' => [
                    'name' => 'American Samoa',
                    'abbr' => 'AS',
                    'region' => '',
                    'capital' => 'Pago Pago',
                ],
                'DC' => [
                    'name' => 'District of Columbia',
                    'abbr' => 'DC',
                    'region' => '',
                    'capital' => 'Washington',
                ],
                'FM' => [
                    'name' => 'Federated States of Micronesia',
                    'abbr' => 'FM',
                    'region' => '',
                    'capital' => 'Palikir',
                ],
                'GU' => [
                    'name' => 'Guam',
                    'abbr' => 'GU',
                    'region' => '',
                    'capital' => 'Hagatna',
                ],
                'MH' => [
                    'name' => 'Marshall Islands',
                    'abbr' => 'MH',
                    'region' => '',
                    'capital' => 'Majuro',
                ],
                'MP' => [
                    'name' => 'Northern Mariana Islands',
                    'abbr' => 'MP',
                    'region' => '',
                    'capital' => 'Saipan',
                ],
                'PW' => [
                    'name' => 'Palau',
                    'abbr' => 'PW',
                    'region' => '',
                    'capital' => 'Koror',
                ],
                'PR' => [
                    'name' => 'Puerto Rico',
                    'abbr' => 'PR',
                    'region' => '',
                    'capital' => 'San Juan',
                ],
                'VI' => [
                    'name' => 'United States Virgin Islands',
                    'abbr' => 'VI',
                    'region' => '',
                    'capital' => 'Charlotte Amalie',
                ],
            ],
        ];
    }
}