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
final class BackstagePass implements GildedItem
{
    private Item $item;

    public function __construct(Item $item)
    {
        $this->item = $item;
    }

    /**
     * {@inheritdoc}
     */
    public function updateQuality(): void
    {
        if ($this->item->sell_in <= 0) {
            $this->item->quality = 0;
            $this->item->sell_in--;
            return;
        }

        if ($this->item->sell_in < 6) {
            $this->item->quality += 3;
            $this->item->sell_in--;
            return;
        }

        if ($this->item->sell_in < 11) {
            $this->item->quality += 2;
            $this->item->sell_in--;
            return;
        }

        $this->item->sell_in--;
        $this->item->quality += 1;
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
