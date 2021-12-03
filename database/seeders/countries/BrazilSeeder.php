<?php

namespace PrionDevelopment\Database\Seeders\Countries;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PrionDevelopment\Geography\Models\Continent;
use PrionDevelopment\Geography\Models\Country;
use PrionDevelopment\Geography\Models\CountryRegion;
use PrionDevelopment\Geography\Models\Division;
use PrionDevelopment\Geography\Models\DivisionType;
use PrionDevelopment\Geography\Models\RegionType;

class BrazilSeeder extends Seeder
{
    protected $name = 'Brazil';
    protected $nameFull = 'Brazil';

    /** @var Country */
    protected $country;

    protected $iso = 'BR';
    protected $isoLong = 'BRA';
    protected $isoNumeric = '076';

    protected $continent = 'South America';
    protected $capital = 'Brasília';

    protected $language = 'Portuguese';

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
                'name' => 'Brazilian Real',
                'abbr' => 'BRL',
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
            'state' => [
                'AC' => [
                    'name' => 'Acre',
                    'abbr' => 'AC',
                    'region' => '',
                    'capital' => 'Rio Branco',
                ],
                'AL' => [
                    'name' => 'Alagoas',
                    'abbr' => 'AL',
                    'region' => '',
                    'capital' => 'Maceió',
                ],
                'AP' => [
                    'name' => 'Amapá',
                    'abbr' => 'AP',
                    'region' => '',
                    'capital' => 'Macapá',
                ],
                'AM' => [
                    'name' => 'Amazonas',
                    'abbr' => 'AM',
                    'region' => '',
                    'capital' => 'Manaus',
                ],
                'BA' => [
                    'name' => 'Bahia',
                    'abbr' => 'BA',
                    'region' => '',
                    'capital' => 'Salvador',
                ],
                'CE' => [
                    'name' => 'Ceará',
                    'abbr' => 'CE',
                    'region' => '',
                    'capital' => 'Fortaleza',
                ],
                'DF' => [
                    'name' => 'Distrito Federal',
                    'abbr' => 'DF',
                    'region' => '',
                    'capital' => 'Brasília',
                ],
                'ES' => [
                    'name' => 'Espírito Santo',
                    'abbr' => 'ES',
                    'region' => '',
                    'capital' => 'Vitória',
                ],
                'GO' => [
                    'name' => 'Goiás',
                    'abbr' => 'GO',
                    'region' => '',
                    'capital' => 'Goiânia',
                ],
                'MA' => [
                    'name' => 'São Luís',
                    'abbr' => 'MA',
                    'region' => '',
                    'capital' => 'Maranhão',
                ],
                'MT' => [
                    'name' => 'Mato Grosso',
                    'abbr' => 'MT',
                    'region' => '',
                    'capital' => 'Cuiabá',
                ],
                'MS' => [
                    'name' => 'Mato Grosso do Sul',
                    'abbr' => 'MS',
                    'region' => '',
                    'capital' => 'Campo Grande',
                ],
                'MG' => [
                    'name' => 'Minas Gerais',
                    'abbr' => 'MG',
                    'region' => '',
                    'capital' => 'Belo Horizonte',
                ],
                'PA' => [
                    'name' => 'Pará',
                    'abbr' => 'PA',
                    'region' => '',
                    'capital' => 'Belém',
                ],
                'PB' => [
                    'name' => 'Paraíba',
                    'abbr' => 'PB',
                    'region' => '',
                    'capital' => 'João Pessoa',
                ],
                'PR' => [
                    'name' => 'Paraná',
                    'abbr' => 'PR',
                    'region' => '',
                    'capital' => 'Curitiba',
                ],
                'PE' => [
                    'name' => 'Pernambuco',
                    'abbr' => 'PE',
                    'region' => '',
                    'capital' => 'Recife',
                ],
                'PI' => [
                    'name' => 'Piauí',
                    'abbr' => 'PI',
                    'region' => '',
                    'capital' => 'Teresina',
                ],
                'RJ' => [
                    'name' => 'Rio de Janeiro',
                    'abbr' => 'RJ',
                    'region' => '',
                    'capital' => 'Rio de Janeiro',
                ],
                'RN' => [
                    'name' => 'Rio Grande do Norte',
                    'abbr' => 'RN',
                    'region' => '',
                    'capital' => 'Natal',
                ],
                'RS' => [
                    'name' => 'Rio Grande do Sul',
                    'abbr' => 'RS',
                    'region' => '',
                    'capital' => 'Porto Alegre',
                ],
                'RO' => [
                    'name' => 'Rondônia',
                    'abbr' => 'RO',
                    'region' => '',
                    'capital' => 'Porto Velho',
                ],
                'RR' => [
                    'name' => 'Roraima',
                    'abbr' => 'RR',
                    'region' => '',
                    'capital' => 'Boa Vista',
                ],
                'SC' => [
                    'name' => 'Santa Catarina',
                    'abbr' => 'SC',
                    'region' => '',
                    'capital' => 'Florianópolis',
                ],
                'SP' => [
                    'name' => 'São Paulo',
                    'abbr' => 'SP',
                    'region' => '',
                    'capital' => 'São Paulo',
                ],
                'SE' => [
                    'name' => 'Sergipe',
                    'abbr' => 'SE',
                    'region' => '',
                    'capital' => 'Aracaju',
                ],
                'TO' => [
                    'name' => 'Tocantins',
                    'abbr' => 'TO',
                    'region' => '',
                    'capital' => 'Palmas',
                ],
            ]
        ];
    }
}