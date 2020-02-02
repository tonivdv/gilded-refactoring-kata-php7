<?php declare(strict_types=1);
/*
 * This file is part of the Adlogix package.
 *
 * (c) Allan Segebarth <allan@adlogix.eu>
 * (c) Jean-Jacques Courtens <jjc@adlogix.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Item;

use App\GildedItem;
use App\Item;

/**
 * @author Toni Van de Voorde
 */
final class Sulfuras implements GildedItem
{
    private Item $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
        $this->item->quality = 80;
    }

    /**
     * {@inheritdoc}
     */
    public function updateQuality(): void
    {
        return;
    }

    public function quality(): int
    {
        return $this->item->quality;
    }

    public function sellIn(): int
    {
        return $this->item->sell_in;
    }
}
