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
final class AgedBrieTest extends TestCase
{
    /**
     * @test
     */
    public function whenAgedBrieGetsOlder_ensureItsQualityIncreases(): void
    {
        $agedBrie = new Item\AgedBrie(
            Name::valueOf("Aged Brie"),
            SellIn::valueOf(10),
            Quality::valueOf(10, 50)
        );

        $agedBrie->updateQuality();

        $this->assertEquals(Quality::valueOf(11, 50), $agedBrie->quality());
    }

    /**
     * @test
     */
    public function whenAgedBrieGetsOlder_ensureQualityIsMax50(): void
    {
        $agedBrie = new Item\AgedBrie(
            Name::valueOf("Aged Brie"),
            SellIn::valueOf(10),
            Quality::valueOf(50, 50)
        );

        $agedBrie->updateQuality();
        $agedBrie->updateQuality();
        $agedBrie->updateQuality();
        $agedBrie->updateQuality();

        $this->assertEquals(Quality::valueOf(50, 50), $agedBrie->quality());
    }
}