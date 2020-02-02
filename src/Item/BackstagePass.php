<?php declare(strict_types=1);

namespace App\Item;

/**
 * @author Toni Van de Voorde
 */
final class BackstagePass implements GildedItem
{
    use GildedItemTrait;

    /**
     * {@inheritdoc}
     */
    public function updateQuality(): void
    {
        $currentSellIn = $this->sellIn;

        $this->decreaseSellIn();
        $this->increaseQuality();

        if ($currentSellIn->lte(10)) {
            $this->increaseQuality();
        }

        if ($currentSellIn->lte(5)) {
            $this->increaseQuality();
        }

        if ($currentSellIn->lte(0)) {
            $this->expireQuality();
        }
    }
}
