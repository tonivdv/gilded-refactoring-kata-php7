<?php declare(strict_types=1);

namespace App\Item;

/**
 * @author Toni Van de Voorde
 */
final class AgedBrie implements GildedItem
{
    use GildedItemTrait;

    /**
     * {@inheritdoc}
     */
    public function updateQuality(): void
    {
        $this->decreaseSellIn();
        $this->increaseQuality();
    }
}
