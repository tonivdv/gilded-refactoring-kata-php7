<?php

namespace App\Tests\Item;

use App\Item;
use App\Item\GildedItemFactory;
use PHPUnit\Framework\TestCase;

/**
 * @author Toni Van de Voorde
 */
final class GildedItemFactoryTest extends TestCase
{
    /**
     * @test
     * @dataProvider itemExamples
     * @param Item $item
     * @param string $expectedInstance
     * @phpstan-param class-string $expectedInstance
     */
    public function fromItem_shouldConvertToGildedItem(Item $item, string $expectedInstance): void
    {
        $gildedItem = GildedItemFactory::fromItem($item);
        $this->assertInstanceOf($expectedInstance, $gildedItem);
    }

    /**
     * @return array<int, array<int, Item|class-string>>
     */
    public function itemExamples(): array
    {
        return [
            [new Item('+5 Dexterity Vest', 10, 20), Item\Standard::class],
            [new Item('Aged Brie', 2, 0), Item\AgedBrie::class],
            [new Item('Sulfuras, Hand of Ragnaros', 0, 80), Item\Sulfuras::class],
            [new Item('Backstage passes to a TAFKAL80ETC concert', 5, 49), Item\BackstagePass::class],
            [new Item('Conjured Mana Cake', 3, 6), Item\Conjured::class],
        ];
    }
}