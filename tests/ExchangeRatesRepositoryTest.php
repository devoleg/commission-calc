<?php

use App\Repository\ExchangeRate\ExchangeRateRepository;

class ExchangeRatesRepositoryTest extends \PHPUnit\Framework\TestCase
{
    public function test()
    {
        $exchangeRateRepository = ExchangeRateRepository::get();

        $base = 'EUR';
        $rates = [
            'EUR' => 1,
            'USD' => 1.25
        ];

        $exchangeRateRepository->setBase($base);
        $exchangeRateRepository->setRates($rates);

        $reteExpectedEUR2USD = 1.25;
        $reteExpectedUSD2EUR = 0.8;

        $this->assertEquals($reteExpectedEUR2USD, $exchangeRateRepository->getRate('EUR', 'USD', 2));
        $this->assertEquals($reteExpectedEUR2USD*100, $exchangeRateRepository->calculate('EUR', 'USD', 100, 2));

        $this->assertEquals($reteExpectedUSD2EUR, $exchangeRateRepository->getRate('USD', 'EUR', 2));
        $this->assertEquals($reteExpectedUSD2EUR*100, $exchangeRateRepository->calculate('USD', 'EUR', 100, 2));
    }
}