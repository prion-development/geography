<?php

namespace PrionDevelopment\Geography\Providers;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\ServiceProvider;
use PrionDevelopment\Geography\Contracts\SetupInterface;

class FactoryProvider extends ServiceProvider implements SetupInterface
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot(): void
    {
        Factory::guessFactoryNamesUsing(function ($name) {
            return (string) '\PrionDevelopment\Geography\Database\Factories\\'.
                (class_basename($name)).
                'Factory';
        });
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
