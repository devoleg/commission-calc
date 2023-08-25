<?php

namespace App\Service;

use App\Interface\CardBinInfoInterface;
use App\Interface\ExchangeRateInterface;
use App\Repository\CardBinInfo\CardBinInfoRepository;
use App\Repository\ExchangeRate\ExchangeRateRepository;

/**
 * Commission calculator service
 */
class Commission
{
    /**
     * @var ExchangeRateInterface
     */
    protected $exchangeRateRepository;

    /**
     * @var CardBinInfoInterface
     */
    protected $cardBinRepository;

    public function __construct($params = [])
    {
        $this->exchangeRateRepository = $params['exchangeRateRepository'] ?? ExchangeRateRepository::get();
        $this->cardBinRepository = $params['cardBinRepository'] ?? CardBinInfoRepository::get();
    }

    /**
     * Calculate commission
     *
     * @param string $bin
     * @param string $amount
     * @param string $currency
     * @param int|null $precision
     * @return float
     */
    public function calculate(string $bin, string $amount, string $currency, ?int $precision = null):  float
    {
        $binData = $this->cardBinRepository->search($bin);

        $commissionPercent = Countries::isEU($binData->getCountryCode())
            ? config('app.commission.EU')
            : config('app.commission.default')
        ;

        $amount = floatval($amount);
        if ($currency !== config('app.baseCurrency')) {
            $amount = $this->exchangeRateRepository->calculate($currency, config('app.baseCurrency'), $amount);
        }

        $commission = $amount * $commissionPercent;
        return $precision !== null ? $this->round($commission, $precision) : $commission;
    }

    /**
     * Round with ceiling
     *
     * @param float $amount
     * @param int $precision
     * @return float
     */
    protected function round(float $amount, int $precision): float
    {
        $fix = pow(10, $precision);
        return ceil($amount*$fix)/$fix;
    }
}