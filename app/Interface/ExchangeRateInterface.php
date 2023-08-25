<?php

namespace App\Interface;

/**
 * Interface for implementing Exchange Rates Services
 */
interface ExchangeRateInterface
{
    /**
     * Set base currency
     *
     * @param string $base
     * @return self
     */
    public function setBase(string $base): self;

    /**
     * Set rates array where key is currency code and value is rate
     *
     * @param array $rates
     * @return self
     */
    public function setRates(array $rates): self;

    /**
     * Get rate for requested currencies
     * 
     * @param string $currencyIn
     * @param string $currencyOut
     * @param int|null $precision
     * @return float
     */
    public function getRate(string $currencyIn, string $currencyOut, ?int $precision = null): float;

    /**
     * Calculate amount by requested currencies
     *
     * @param string $currencyIn
     * @param string $currencyOut
     * @param float $value
     * @param int|null $precision
     * @return float
     */
    public function calculate(string $currencyIn, string $currencyOut, float $value, ?int $precision = null): float;
}