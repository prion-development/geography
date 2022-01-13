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

class MexicoSeeder extends Seeder
{
    protected $name = 'Mexico';
    protected $nameFull = 'United Mexican States';

    /** @var Country */
    protected $country;

    protected $iso = 'MX';
    protected $isoLong = 'MEX';
    protected $isoNumeric = '484';

    protected $continent = 'North America';
    protected $capital = 'Mexico City';

    protected $language = 'Spanish';

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
                'name' => 'Peso',
                'abbr' => 'MXN',
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
            'Spanish',
        ];
    }

    public function divisions(): array
    {
        return [
            'state' => [
                'AG' => [
                    'name' => 'Aguascalientes',
                    'abbr' => 'AG',
                    'region' => '',
                    'capital' => '',
                ],
                'BC' => [
                    'name' => 'Baja California',
                    'abbr' => 'BC',
                    'region' => '',
                    'capital' => '',
                ],
                'BS' => [
                    'name' => 'Baja California Sur',
                    'abbr' => 'BS',
                    'region' => '',
                    'capital' => '',
                ],
                'CH' => [
                    'name' => 'Chihuahua',
                    'abbr' => 'CH',
                    'region' => '',
                    'capital' => '',
                ],
                'CL' => [
                    'name' => 'Colima',
                    'abbr' => 'CL',
                    'region' => '',
                    'capital' => '',
                ],
                'CM' => [
                    'name' => 'Campeche',
                    'abbr' => 'CM',
                    'region' => '',
                    'capital' => '',
                ],
                'CO' => [
                    'name' => 'Coahuila',
                    'abbr' => 'CO',
                    'region' => '',
                    'capital' => '',
                ],
                'CS' => [
                    'name' => 'Chiapas',
                    'abbr' => 'CS',
                    'region' => '',
                    'capital' => '',
                ],
                'DF' => [
                    'name' => 'Federal District',
                    'abbr' => 'DF',
                    'region' => '',
                    'capital' => '',
                ],
                'DG' => [
                    'name' => 'Durango',
                    'abbr' => 'DG',
                    'region' => '',
                    'capital' => '',
                ],
                'GR' => [
                    'name' => 'Guerrero',
                    'abbr' => 'GR',
                    'region' => '',
                    'capital' => '',
                ],
                'GT' => [
                    'name' => 'Guanajuato',
                    'abbr' => 'GT',
                    'region' => '',
                    'capital' => '',
                ],
                'HG' => [
                    'name' => 'Hidalgo',
                    'abbr' => 'HG',
                    'region' => '',
                    'capital' => '',
                ],
                'JA' => [
                    'name' => 'Jalisco',
                    'abbr' => 'JA',
                    'region' => '',
                    'capital' => '',
                ],
                'ME' => [
                    'name' => 'México State',
                    'abbr' => 'ME',
                    'region' => '',
                    'capital' => '',
                ],
                'MI' => [
                    'name' => 'Michoacán',
                    'abbr' => 'MI',
                    'region' => '',
                    'capital' => '',
                ],
                'MO' => [
                    'name' => 'Morelos',
                    'abbr' => 'MO',
                    'region' => '',
                    'capital' => '',
                ],
                'NA' => [
                    'name' => 'Nayarit',
                    'abbr' => 'NA',
                    'region' => '',
                    'capital' => '',
                ],
                'NL' => [
                    'name' => 'Nuevo León',
                    'abbr' => 'NL',
                    'region' => '',
                    'capital' => '',
                ],
                'OA' => [
                    'name' => 'Oaxaca',
                    'abbr' => 'OA',
                    'region' => '',
                    'capital' => '',
                ],
                'PB' => [
                    'name' => 'Puebla',
                    'abbr' => 'PB',
                    'region' => '',
                    'capital' => '',
                ],
                'QE' => [
                    'name' => 'Querétaro',
                    'abbr' => 'QE',
                    'region' => '',
                    'capital' => '',
                ],
                'QR' => [
                    'name' => 'Quintana Roo',
                    'abbr' => 'QR',
                    'region' => '',
                    'capital' => '',
                ],
                'SI' => [
                    'name' => 'Sinaloa',
                    'abbr' => 'SI',
                    'region' => '',
                    'capital' => '',
                ],
                'SL' => [
                    'name' => 'San Luis Potosí',
                    'abbr' => 'SL',
                    'region' => '',
                    'capital' => '',
                ],
                'SO' => [
                    'name' => 'Sonora',
                    'abbr' => 'SO',
                    'region' => '',
                    'capital' => '',
                ],
                'TB' => [
                    'name' => 'Tabasco',
                    'abbr' => 'TB',
                    'region' => '',
                    'capital' => '',
                ],
                'TL' => [
                    'name' => 'Tlaxcala',
                    'abbr' => 'TL',
                    'region' => '',
                    'capital' => '',
                ],
                'TM' => [
                    'name' => 'Tamaulipas',
                    'abbr' => 'TM',
                    'region' => '',
                    'capital' => '',
                ],
                'VE' => [
                    'name' => 'Veracruz',
                    'abbr' => 'VE',
                    'region' => '',
                    'capital' => '',
                ],
                'YU' => [
                    'name' => 'Yucatán',
                    'abbr' => 'YU',
                    'region' => '',
                    'capital' => '',
                ],
                'ZAS' => [
                    'name' => 'Zacatecas',
                    'abbr' => 'ZA',
                    'region' => '',
                    'capital' => '',
                ],
            ],
        ];
    }
}
