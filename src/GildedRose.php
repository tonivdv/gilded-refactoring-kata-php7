<?php declare(strict_types=1);

namespace App;

use Webmozart\Assert\Assert;

final class GildedRose
{
    /**
     * @var array<GildedItem>|GildedItem[]
     */
    private array $items = [];

    /**
     * @param array<GildedItem> $items
     */
    public function __construct(array $items)
    {
        Assert::allIsInstanceOf($items, GildedItem::class);
        $this->items = $items;
    }

    public function updateQuality(): void
    {
        foreach ($this->items as $item) {
            $item->updateQuality();
        }
    }
}
