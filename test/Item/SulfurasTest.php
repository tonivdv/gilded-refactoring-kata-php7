<?php
/*
 * This file is part of the Adlogix package.
 *
 * (c) Allan Segebarth <allan@adlogix.eu>
 * (c) Jean-Jacques Courtens <jjc@adlogix.eu>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Tests\Item;


use App\GildedRose;
use App\Item;
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
        $item = new Item("Sulfuras, Hand of Ragnaros", 10, 80);
        $sulfuras = new Item\Sulfuras($item);
        $sulfuras->updateQuality();
        $this->assertEquals(10, $item->sell_in);
        $this->assertEquals(80, $item->quality);
    }
}