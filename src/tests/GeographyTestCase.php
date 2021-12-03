<?php

namespace PrionDevelopment\Geography\tests;

abstract class GeographyTestCase extends \Orchestra\Testbench\TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        $this->loadLaravelMigrations();
        $this->artisan('migrate')->run();

        $migrationsDirectory = "{$this->baseDirectory()}/database/migrations";
        $this->loadMigrationsFrom($migrationsDirectory);
        $this->artisan('migrate', [
            '--realpath' => realpath($migrationsDirectory),
        ])->run();

        $this->withFactories("{$this->baseDirectory()}/database/factories");
    }

    protected function getPackageProviders($app)
    {
        return [
            '\PrionDevelopment\Geography\Providers\ConfigProvider',
            'PrionDevelopment\Geography\GeographyServiceProvider',
            'PrionDevelopment\Geography\Providers\FactoryProvider'
        ];
    }

    protected function baseDirectory(): string
    {
        return dirname(__DIR__, 2);
    }
}