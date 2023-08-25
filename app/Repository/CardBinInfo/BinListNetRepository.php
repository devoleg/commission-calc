<?php

namespace App\Repository\CardBinInfo;

use App\Interface\CardBinInfoInterface;
use App\Response\CardInfo;

/**
 * Repository for working with https://lookup.binlist.net
 */
class BinListNetRepository implements CardBinInfoInterface
{
    protected $url = 'https://lookup.binlist.net/';

    /**
     * Get card info from third party service
     *
     * @param string $bin
     * @return object|null
     */
    protected function request(string $bin): ?object
    {
        return @json_decode(file_get_contents($this->url . $bin));
    }

    /**
     * Search bin info
     *
     * @param string $bin
     * @return CardInfo
     */
    public function search(string $bin): CardInfo
    {
        $data = $this->request($bin);
        if (!$data) {
            throw new \Exception('BinList.net API not accessible');
        }
        $card = new CardInfo();
        $card->setBin($bin)
            ->setBank($data->bank->name ?? null)
            ->setScheme($data->scheme ?? null)
            ->setType($data->type ?? null)
            ->setCountryName($data->country->name)
            ->setCountryCode($data->country->alpha2)
        ;
        return $card;
    }
}