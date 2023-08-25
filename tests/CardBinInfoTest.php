<?php

use App\Repository\CardBinInfo\CardBinInfoRepository;
use App\Response\CardInfo;

class CardBinInfoTest extends \PHPUnit\Framework\TestCase
{
    public function test()
    {
        $cardBinInfo = CardBinInfoRepository::get();

        $cardBinInfo = $cardBinInfo->search('45717360');

        $this->assertInstanceOf(CardInfo::class, $cardBinInfo);
        $this->assertEquals('DK', $cardBinInfo->getCountryCode());
    }
}