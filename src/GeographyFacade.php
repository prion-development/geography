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

use Illuminate\Support\Facades\Facade;

class GeographyFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'geography';
    }
}
