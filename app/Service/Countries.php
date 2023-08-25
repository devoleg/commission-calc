<?php

namespace App\Service;

/**
 * Class for improving work with countries data
 */
class Countries
{
    /**
     * Country codes list from EU
     */
    const EU_CODES = [
        'AT',
        'BE',
        'BG',
        'CY',
        'CZ',
        'DE',
        'DK',
        'EE',
        'ES',
        'FI',
        'FR',
        'GR',
        'HR',
        'HU',
        'IE',
        'IT',
        'LT',
        'LU',
        'LV',
        'MT',
        'NL',
        'PO',
        'PT',
        'RO',
        'SE',
        'SI',
        'SK',
    ];

    /**
     * Check if country code is from EU
     *
     * @param string $code
     * @return bool
     */
    public static function isEU(string $code): bool
    {
        return in_array(strtoupper($code), self::EU_CODES);
    }
}