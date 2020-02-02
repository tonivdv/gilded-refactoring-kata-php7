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
final class SulfurasTest extends TestCase
{
    /**
     * @test
     */
    public function sulfurasItem_shouldNeverBeSoldOrIncreaseInQuality(): void
    {
        $sulfuras = new Item\Sulfuras(Name::valueOf("Sulfuras"), SellIn::valueOf(1), Quality::valueOf(10, 80));
        $sulfuras->updateQuality();
        $this->assertEquals(SellIn::valueOf(1), $sulfuras->sellIn());
        $this->assertEquals(Quality::valueOf(10, 80), $sulfuras->quality());
    }
}