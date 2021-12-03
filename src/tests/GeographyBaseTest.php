<?php

namespace PrionDevelopment\Geography\tests;

class GeographyBaseTest extends GeographyTestCase
{
    /**
     * @test
     */
    public function testDatabaseTables()
    {
        $tables = app('config')->get('prion-geography.database.tables');
        foreach ($tables as $table) {
            $this->assertCount(0, \Illuminate\Support\Facades\DB::table($table)->get());
        }
    }
}
