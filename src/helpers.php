<?php

/**
 * This file is part of Prion Development's Geography Package,
 * an package to populate a database with geography data.
 *
 * @license MIT
 * @company Prion Development
 * @package Geography
 */

/**
 * Determine the Default Database Driver
 *
 * @return string
 */
if (!function_exists('databaseDriver')) {
    function databaseDriver(): string
    {
        $connection = config('database.default');
        return strtolower(config("database.connections.{$connection}.driver"));
    }
}

if (!function_exists('isDatabaseDriver')) {
    function isDatabaseDriver(string $driver): bool
    {
        return databaseDriver() === $driver;
    }
}

if (!function_exists('randomString')) {
    function randomString(int $length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

if (!function_exists('urlFilter')) {
    function urlFilter($pathPrefix)
    {
        $pathPrefix = trim($pathPrefix, "/");
        $pathPrefix = strtolower($pathPrefix);
        $pathPrefix = explode("?", $pathPrefix);
        $pathPrefix = explode("#", $pathPrefix[0]);

        return $pathPrefix[0];
    }
}
