<?php declare(strict_types=1);

namespace App\Tests;

use App\GildedRose;
use App\Item;
use PHPUnit\Framework\TestCase;

/**
 * @author Toni Van de Voorde
 */
final class GildedRoseTest extends TestCase
{
    /**
     * @test
     */
    public function updateQuality_withValidGildedItems_shouldExecuteUpdateQuality(): void
    {
        $gildedItem = $this->createMock(Item\GildedItem::class);
        $gildedItem
            ->expects($this->once())
            ->method('updateQuality');

        (new GildedRose([$gildedItem]))->updateQuality();
    }
}
