<?php declare(strict_types=1);

namespace App\Tests;

use App\GildedRose;
use App\Item;
use PHPUnit\Framework\TestCase;

final class GildedRoseTest extends TestCase
{
    /**
     * @test
     */
    public function whenSellDateIsNotPassed_qualityDegrades(): void
    {
        $item = new Item\Standard(new Item("foo", 1, 10));
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertEquals(9, $item->quality());
    }

    /**
     * @test
     */
    public function whenSellDateIsPassed_qualityDegradesTwiceAsFast(): void
    {
        $item = new Item\Standard(new Item("foo", 0, 10));
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertEquals(8, $item->quality());
    }

    /**
     * @test
     */
    public function whenQualityDropsToZero_ensureItBecomesNotNegative(): void
    {
        $item = new Item\Standard(new Item("foo", 1, 0));
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertEquals(0, $item->quality());
    }

    /**
     * @test
     */
    public function whenAgedBrieGetsOlder_ensureItsQualityIncreases(): void
    {
        $item = new Item\AgedBrie(new Item("Aged Brie", 10, 10));
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertEquals(11, $item->quality());
    }

    /**
     * @test
     */
    public function qualityIncreasableItems_shouldNeverBeHigherThan50(): void
    {
        $item = new Item\AgedBrie(new Item("Aged Brie", 10, 50));
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertEquals(50, $item->quality());
    }

    /**
     * @test
     */
    public function sulfurasItem_shouldNeverBeSoldOrIncreaseInQuality(): void
    {
        $item = new Item\Sulfuras(new Item("Sulfuras, Hand of Ragnaros", 10, 80));
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertEquals(10, $item->sellIn());
        $this->assertEquals(80, $item->quality());
    }

    /**
     * @test
     * @dataProvider backstagePassesSellInAndQualityExamples
     * @param int $sellIn
     * @param int $quality
     * @param int $expectedRemainingQuality
     */
    public function backstagePasses_increasesDifferentlyDependingOnRemainingSellInDays(
        int $sellIn,
        int $quality,
        int $expectedRemainingQuality
    ): void {
        $item = new Item\BackstagePass(new Item("Backstage passes to a TAFKAL80ETC concert", $sellIn, $quality));
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertEquals($expectedRemainingQuality, $item->quality());
    }

    /**
     * @return array<array>
     */
    public function backstagePassesSellInAndQualityExamples(): array
    {
        return [
            [20, 10, 11],
            [10, 10, 12],
            [6, 10, 12],
            [5, 10, 13],
            [0, 10, 0],
        ];
    }

    /**
     * @test
     */
    public function conjuredItems_shouldIncreaseTwiceAsFastAsNormalItems(): void
    {
        $item = new Item\Conjured(new Item("Conjured", 10, 50));
        $gildedRose = new GildedRose([$item]);
        $gildedRose->updateQuality();
        $this->assertEquals(48, $item->quality());
    }
}
