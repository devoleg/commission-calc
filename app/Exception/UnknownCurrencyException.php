<?php

namespace App\Exception;

use Exception;

/**
 * Exception throws if requested exchange rate for unknown currency
 */
class UnknownCurrencyException extends Exception
{
    protected $message = 'Unknown currency';
}