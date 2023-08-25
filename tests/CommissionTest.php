<?php

use App\Service\Commission;

class CommissionTest extends \PHPUnit\Framework\TestCase
{
    public function test()
    {
        $commissionService = new Commission();

        $commission = $commissionService->calculate('45717360', 100, config('app.baseCurrency'), 2);
        $this->assertEquals(config('app.commission.EU')*100, $commission);
    }
}