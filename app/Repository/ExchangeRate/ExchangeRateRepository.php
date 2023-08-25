<?php

namespace App\Repository\ExchangeRate;

use App\Interface\ExchangeRateInterface;

/**
 * Get repository for exchange rate
 */
class ExchangeRateRepository
{
    /**
     * @return ExchangeRateInterface
     */
    public static function get(): ExchangeRateInterface
    {
        return new ExchangeRatesApiIoRepository();
    }
}