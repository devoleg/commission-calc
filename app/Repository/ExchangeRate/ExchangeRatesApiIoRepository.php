<?php

namespace App\Repository\ExchangeRate;

use App\Exception\UnknownCurrencyException;
use App\Interface\ExchangeRateInterface;

/**
 * Repository for working with https://exchangeratesapi.io
 */
class ExchangeRatesApiIoRepository implements ExchangeRateInterface
{
    /**
     * @var string API Key
     */
    protected $apiKey;

    /**
     * @var bool Is data loaded
     */
    protected $loaded = false;

    /**
     * @var string Base currency
     */
    protected $base;

    /**
     * @var array Rates
     */
    protected $rates;

    /**
     * Constructor
     *
     * @throws \Exception
     */
    public function __construct()
    {
        $this->apiKey = config('app.exchangeratesapi.key');
        if (!$this->loaded) {
            $this->loadRates();
        }
    }

    /**
     * Load rates from API
     *
     * @return void
     * @throws \Exception
     */
    public function loadRates()
    {
        $data = @json_decode(file_get_contents('http://api.exchangeratesapi.io/latest?access_key='.$this->apiKey));
        if (!$data || !($data->success??null)) {
            throw new \Exception('Exchange rate API website not accessible');
        }
        $this->setBase($data->base);
        $this->setRates((array)$data->rates);
        $this->loaded = true;
    }

    /**
     * Set base currency
     *
     * @param string $base
     * @return self
     */
    public function setBase(string $base): self
    {
        $this->base = $base;
        return $this;
    }

    /**
     * Set rates array where key is currency code and value is rate
     *
     * @param array $rates
     * @return self
     */
    public function setRates(array $rates): self
    {
        $this->rates = $rates;
        return $this;
    }

    /**
     * Get rate for requested currencies
     *
     * @param string $currencyIn
     * @param string $currencyOut
     * @param int|null $precision
     * @return float
     */
    public function getRate(string $currencyIn, string $currencyOut, ?int $precision = null): float
    {
        $currencyIn = strtoupper($currencyIn);
        $currencyOut = strtoupper($currencyOut);

        if (!array_key_exists($currencyIn, $this->rates) || !array_key_exists($currencyOut, $this->rates)) {
            throw new UnknownCurrencyException();
        }

        if ($currencyIn === $this->base) {
            $rate = $this->rates[$currencyOut];
        } else {
            $rate = $this->rates[$currencyIn] !== 0 ? (1/$this->rates[$currencyIn]) : 0;
        }

        return $precision === null ? $rate : round($rate, $precision);
    }

    /**
     * Calculate amount by requested currencies
     *
     * @param string $currencyIn
     * @param string $currencyOut
     * @param float $value
     * @param int|null $precision
     * @return float
     */
    public function calculate(string $currencyIn, string $currencyOut, float $value, ?int $precision = null): float
    {
        $value = $value * $this->getRate($currencyIn, $currencyOut);
        return $precision === null ? $value : round($value, $precision);
    }
}