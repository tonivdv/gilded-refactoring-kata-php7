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
final class BackstagePassTest extends TestCase
{
    /**
     * @test
     * @dataProvider backstagePassesSellInAndQualityExamples
     * @param SellIn $sellIn
     * @param Quality $quality
     * @param Quality $expectedRemainingQuality
     */
    public function backstagePasses_increasesDifferentlyDependingOnRemainingSellInDays(
        SellIn $sellIn,
        Quality $quality,
        Quality $expectedRemainingQuality
    ): void {
        $backstagePass = new Item\BackstagePass(
            Name::valueOf("Backstage passes to a TAFKAL80ETC concert"),
            $sellIn,
            $quality
        );
        $backstagePass->updateQuality();
        $this->assertEquals($expectedRemainingQuality, $backstagePass->quality());
    }

    /**
     * @return array<array>
     */
    public function backstagePassesSellInAndQualityExamples(): array
    {
        return [
            [SellIn::valueOf(20), Quality::valueOf(10, 50), Quality::valueOf(11, 50)],
            [SellIn::valueOf(10), Quality::valueOf(10, 50), Quality::valueOf(12, 50)],
            [SellIn::valueOf(6), Quality::valueOf(10, 50), Quality::valueOf(12, 50)],
            [SellIn::valueOf(5), Quality::valueOf(10, 50), Quality::valueOf(13, 50)],
            [SellIn::valueOf(0), Quality::valueOf(10, 50), Quality::valueOf(0, 50)],
        ];
    }
}