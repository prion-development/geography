<?php

return [
    /**
    |---------------------------------------------------------------------------
    |   Set Cache for Geogrpahy Data
    |---------------------------------------------------------------------------
    |
    |   Turn the cache on/off and set the lenght of time to store in cache.
    |   This is to reduce the number of file lookups. The world has over 260
    |   countries. Lookup up 260 data files will take time.
    |
     */

    'use_cache' => env('PRIONDEVELOPMENT_GEOGRAPHY_CACHE', true), // true or false

    'cache_ttl' => env('PRIONDEVELOPMENT_GEOGRAPHY_CACHE_TTL', 60), // in minutes

    'database' => [
        'tables' => [
            'continents' => env('PRIONDEVELOPMENT_GEOGRAPHY_TABLE_CONTINENTS', 'continents'),
            'countries' => env('PRIONDEVELOPMENT_GEOGRAPHY_TABLE_COUNTRIES', 'countries'),
            'country_regions' => env('PRIONDEVELOPMENT_GEOGRAPHY_TABLE_COUNTRY_REGIONS', 'country_regions'),
            'divisions' => env('PRIONDEVELOPMENT_GEOGRAPHY_TABLE_DIVISIONS', 'divisions'),
            'division_types' => env('PRIONDEVELOPMENT_GEOGRAPHY_TABLE_DIVISION_TYPES', 'division_types'),
            'localities' => env('PRIONDEVELOPMENT_GEOGRAPHY_TABLE_LOCALITY', 'localities'),
            'locality_types' => env('PRIONDEVELOPMENT_GEOGRAPHY_TABLE_LOCALITY_TYPES', 'locality_types'),
            'postcodes' => env('PRIONDEVELOPMENT_GEOGRAPHY_TABLE_POSTCODE', 'postcodes'),
        ]
    ]
];