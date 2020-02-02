<?php

namespace App\Tests\Item;

use App\Item;
use App\Name;
use App\Quality;
use App\SellIn;
use PHPUnit\Framework\TestCase;

/**
 * @author Toni Van de Voorde
 */
final class StandardTest extends TestCase
{
    /**
     * @test
     */
    public function whenSellDateIsNotPassed_qualityDegrades(): void
    {
        $standard = new Item\Standard(
            Name::valueOf("foo"), SellIn::valueOf(1), Quality::valueOf(10, 50)
        );
        $standard->updateQuality();
        $this->assertEquals(Quality::valueOf(9, 50), $standard->quality());
    }

    /**
     * @test
     */
    public function whenSellDateIsPassed_qualityDegradesTwiceAsFast(): void
    {
        $standard = new Item\Standard(
            Name::valueOf("foo"), SellIn::valueOf(0), Quality::valueOf(10, 50)
        );
        $standard->updateQuality();
        $this->assertEquals(Quality::valueOf(8, 50), $standard->quality());
    }
}