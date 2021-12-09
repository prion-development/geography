<?php

namespace PrionDevelopment\Geography\Providers;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\ServiceProvider;
use PrionDevelopment\Geography\Contracts\SetupInterface;

class SeederProvider extends ServiceProvider implements SetupInterface
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../../database/seeders/' => database_path('seeders')
        ], 'geography-seeders');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register(): void
    {
    }
}
