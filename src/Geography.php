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

class Geography
{
    /**
     * Laravel application.
     *
     * @var \Illuminate\Foundation\Application
     */
    public $app;

    /**
     * Create a new instance.
     *
     * @param  \Illuminate\Foundation\Application $app
     * @return void
     */
    public function __construct($app)
    {
        $this->app = $app;
    }
}
