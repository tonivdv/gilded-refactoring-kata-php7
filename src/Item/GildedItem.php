<?php declare(strict_types=1);

namespace App\Item;

use App\Name;
use App\Quality;
use App\SellIn;

/**
 * @author Toni Van de Voorde
 */
interface GildedItem
{
    public function updateQuality(): void;

    public function name(): Name;

    public function quality(): Quality;

    public function sellIn(): SellIn;
}
