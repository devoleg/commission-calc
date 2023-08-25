<?php

namespace App\Command;

use App\Repository\CardBinInfo\CardBinInfoRepository;
use App\Repository\ExchangeRate\ExchangeRateRepository;
use App\Service\Commission;
use App\Service\FileReader;

/**
 * Application command
 */
class AppCommand
{
    /**
     * Run application
     *
     * @param string $inputFilePath Relative or absolute path to file
     * @return int
     * @throws \App\Exception\BadFileException
     */
    public function run(string $inputFilePath): int
    {
        $exchangeRateRepository = ExchangeRateRepository::get();
        $cardBinRepository = CardBinInfoRepository::get();

        $commissionService = new Commission([
            'exchangeRateRepository' => $exchangeRateRepository,
            'cardBinRepository' => $cardBinRepository
        ]);

        $reader = new FileReader($inputFilePath);

        $reader->readLineByLine(function($line) use ($commissionService) {
            $data = json_decode($line);
            $commission = $commissionService->calculate($data->bin, $data->amount, $data->currency, 2);
            echo $commission."\n";
        });

        return 0;
    }
}