<?php declare(strict_types=1);

namespace App\Item;

use App\Item;
use App\Name;
use App\Quality;
use App\SellIn;

/**
 * @author Toni Van de Voorde
 */
final class GildedItemFactory
{
    public static function toItem(GildedItem $gildedItem): Item
    {
        return new Item(
            $gildedItem->name()->asString(),
            $gildedItem->sellIn()->asInt(),
            $gildedItem->quality()->asInt()
        );
    }

    public static function fromItem(Item $item): GildedItem
    {
        switch ($item->name) {
            case 'Aged Brie':
                return new AgedBrie(
                    Name::valueOf($item->name),
                    SellIn::valueOf($item->sell_in),
                    Quality::valueOf($item->quality, 50)
                );
            case 'Backstage passes to a TAFKAL80ETC concert':
                return new BackstagePass(
                    Name::valueOf($item->name),
                    SellIn::valueOf($item->sell_in),
                    Quality::valueOf($item->quality, 50)
                );
            case 'Sulfuras, Hand of Ragnaros':
                return new Sulfuras(
                    Name::valueOf($item->name),
                    SellIn::valueOf($item->sell_in),
                    Quality::valueOf($item->quality, 80)
                );
            case 'Conjured Mana Cake':
                return new Conjured(
                    Name::valueOf($item->name),
                    SellIn::valueOf($item->sell_in),
                    Quality::valueOf($item->quality, 50)
                );
            default:
                return new Standard(
                    Name::valueOf($item->name),
                    SellIn::valueOf($item->sell_in),
                    Quality::valueOf($item->quality, 50)
                );
        }
    }
}
