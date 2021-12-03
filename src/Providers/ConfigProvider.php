<?php

namespace PrionDevelopment\Geography\Providers;

/**
 * This file is part of Prion Development's Geography Package,
 * an package to populate a database with geography data.
 *
 * @license MIT
 * @company Prion Development
 * @package Geography
 */

use Illuminate\Support\ServiceProvider;
use PrionDevelopment\Geography\Contracts\ProviderInterface;

class ConfigProvider extends ServiceProvider implements ProviderInterface
{
    private $config = [
        'prion-geography'
    ];

    /**
     * Publish the Configuration File
     */
    public function boot(): void
    {
        $this->configPublish();
    }

    public function register(): void
    {
        $this->configMerge();
    }

    /**
     * Merge in the Default Configuration. This is used if the config has
     * not been added to the Laravel/Lumen config directory
     */
    private function configMerge()
    {
        foreach ($this->config as $config) {
            $this->mergeConfigFrom(
                __DIR__ . '/../../config/' . $config . '.php',
                $config
            );
        }
    }

    /**
     * Copy the configs to the Lumen/Laravel config directory
     */
    private function configPublish()
    {
        foreach ($this->config as $config) {
            $app_path = app()->basePath('config/'. $config .'.php');
            $this->publishes([
                __DIR__ . '/../../config/'. $config .'.php' => $app_path,
            ], $config);
        }
    }
}
