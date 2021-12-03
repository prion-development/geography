<?php

namespace PrionDevelopment\Geography;

/**
 * This file is part of Prion Development's Geography Package,
 * an package to populate a database with geography data.
 *
 * @license MIT
 * @company Prion Development
 * @package Geography
 */

use Illuminate\Support\ServiceProvider;

class GeographyServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /** @var array */
    protected $setup = [
        \PrionDevelopment\Geography\Providers\ConfigProvider::class,
        \PrionDevelopment\Geography\Providers\FactoryProvider::class,
        \PrionDevelopment\Geography\Providers\MigrationProvider::class,
    ];

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerSetting();
        $this->registerProviders();
    }

    /**
     * Register Setting in Laravel/Lumen
     *
     */
    private function registerSetting(): void
    {
        $this->app->singleton('geography', function ($app) {
            return app(\PrionDevelopment\Geography\Geography::class, ['app' => $app]);
        });

        $loader = \Illuminate\Foundation\AliasLoader::getInstance();
        $loader->alias('Geography', \PrionDevelopment\Geography\GeographyFacade::class);
    }

    /**
     * Register Additional Providers, such as config setup
     * and command setup
     */
    private function registerProviders(): void
    {
        foreach($this->setup as $setup) {
            $this->app->register($setup);
        }
    }
}
