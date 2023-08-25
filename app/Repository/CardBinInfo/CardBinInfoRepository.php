<?php

namespace App\Repository\CardBinInfo;

use App\Interface\CardBinInfoInterface;

/**
 * Get repository for card bin
 */
class CardBinInfoRepository
{
    /**
     * @return CardBinInfoInterface
     */
    public static function get(): CardBinInfoInterface
    {
        return new BinListNetRepository();
    }
}