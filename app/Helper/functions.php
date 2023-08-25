<?php

use App\Service\Config;

/**
 * Get environment variable
 *
 * @param string $key Requested key
 * @param mixed|null $default Default value if key not found
 * @return mixed|null
 */
function env(string $key, $default = null)
{
    return array_key_exists($key, $_ENV) ? $_ENV[$key] : $default;
}

/**
 * Get config variable through function
 *
 * @param string $scope
 * @return null
 */
function config(string $variable)
{
    return Config::get($variable);
}