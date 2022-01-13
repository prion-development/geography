<?php

namespace PrionDevelopment\Database\Seeders\Countries\Us;

use App\Models\Address\Country;
use App\Models\Address\Division;
use App\Models\Address\LocalityType;
use Illuminate\Database\Seeder;
use PrionDevelopment\Geography\Models\DivisionType;
use PrionDevelopment\Geography\Models\Locality;
use PrionDevelopment\Geography\Models\Postcode;

class ArizonaPostcodeSeeder extends Seeder
{
    /** @var string[] */
    protected $postcodes = [
        'Chandler' => [
            'locality' => "Chandler",
            'locality_type' => "town",
            'division' => "AZ",
            'division_type' => "state",
            'country' => "US",
            'postcodes' => [
                85224,85225,85226,85244,85246,85248,85249,85286,
            ]
        ],
        'Gilbert' => [
            'locality' => "Gilbert",
            'locality_type' => "town",
            'division' => "AZ",
            'division_type' => "state",
            'country' => "US",
            'postcodes' => [
                85296, 85233, 85234, 85295, 85297, 85298,
            ]
        ],
        'Mesa' => [
            'locality' => "Mesa",
            'locality_type' => "city",
            'division' => "AZ",
            'division_type' => "state",
            'country' => "US",
            'postcodes' => [
                85201,85202,85203,85204,85205,85206,85207,85208,85209,85210,85211,85212,85213,85214,85215,85216,85274,85275,85277
            ]
        ],
        'Phoenix' => [
            'locality' => "Phoenix",
            'locality_type' => "city",
            'division' => "AZ",
            'division_type' => "state",
            'country' => "US",
            'postcodes' => [
                85001,85002,85003,85004,85005,85006,85007,85008,85009,85010,85011,85012,85013,85014,85015,85016,85017,85018,85019,85020,85021,85022,85023,85024,85025,85026,85027,85028,85029,85030,85031,85032,85033,85034,85035,85036,85037,85038,85039,85040,85041,85042,85043,85044,85045,85046,85048,85050,85051,85053,85054,85055,85060,85061,85062,85063,85064,85065,85066,85067,85068,85069,85070,85071,85072,85073,85074,85075,85076,85077,85078,85079,85080,85082,85083,85085,85086,85096,85097,85098,85099
            ]
        ],
        'Scottsdale' => [
            'locality' => "Scottsdale",
            'locality_type' => "city",
            'division' => "AZ",
            'division_type' => "state",
            'country' => "US",
            'postcodes' => [
                85008, 85018, 85054, 85250, 85251, 85253, 85254, 85255, 85257, 85258, 85259, 85260, 85262, 85266, 85268, 85281, 85331
            ]
        ],
        'Tuscon' => [
            'locality' => "Tuscon",
            'locality_type' => "city",
            'division' => "AZ",
            'division_type' => "state",
            'country' => "US",
            'postcodes' => [
                85701,85702,85703,85704,85705,85706,85707,85708,85709,85710,85711,85712,85713,85714,85715,85716,85717,85718,85719,85720,85721,85722,85723,85724,85725,85726,85728,85730,85731,85732,85733,85734,85735,85736,85737,85739,85740,85741,85742,85743,85744,85745,85746,85747,85748,85749,85750,85751,85752,85754,85755,85756,85757,85775,85777
            ]
        ],
    ];

    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->postcodes as $city => $data) {
            $country = Country::fromIso($data['country']);
            $divisionType = DivisionType::fromName($data['division_type']);
            $division = Division::where('abbreviation', $data['division'])
                ->where('division_type_id', $divisionType->id)
                ->where('country_id', $country->id)
                ->limit(1)->first();
            $localityType = LocalityType::fromName($data['locality_type']);
            $locality = Locality::firstOrCreate([
                'name' => $data['locality'],
                'locality_type_id' => $localityType->id,
                'division_id' => $division->id,
            ]);

            foreach ($data['postcodes'] as $postcode) {
                Postcode::firstOrCreate([
                    'postcode' => $postcode,
                    'locality_id' => $locality->id,
                    'division_id' => $division->id,
                ]);
            }
        }
    }
}
