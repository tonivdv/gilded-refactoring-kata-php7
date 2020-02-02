<?php

namespace App\Tests\Item;

use App\Item;
use PHPUnit\Framework\TestCase;

final class AgedBrieTest extends TestCase
{
    /**
     * @test
     */
    public function whenAgedBrieGetsOlder_ensureItsQualityIncreases(): void
    {
        $item = new Item("Aged Brie", 10, 10);
        $agedBrie = new Item\AgedBrie($item);
        $agedBrie->updateQuality();
        $this->assertEquals(11, $agedBrie->quality());
    }
}