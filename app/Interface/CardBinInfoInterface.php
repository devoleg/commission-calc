<?php

namespace App\Interface;

use App\Response\CardInfo;

/**
 * Interface for checking card information by bin
 */
interface CardBinInfoInterface
{
    /**
     * Search bin info
     *
     * @param string $bin
     * @return CardInfo
     */
    public function search(string $bin): CardInfo;
}