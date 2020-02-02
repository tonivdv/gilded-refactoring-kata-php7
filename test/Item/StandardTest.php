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

final class StandardTest extends TestCase
{
    /**
     * @test
     */
    public function whenSellDateIsNotPassed_qualityDegrades(): void
    {
        $item = new Item("foo", 1, 10);
        $standard = new Item\Standard($item);
        $standard->updateQuality();
        $this->assertEquals(9, $item->quality);
    }

    /**
     * @test
     */
    public function whenSellDateIsPassed_qualityDegradesTwiceAsFast(): void
    {
        $item = new Item("foo", 0, 10);
        $standard = new Item\Standard($item);
        $standard->updateQuality();
        $this->assertEquals(8, $item->quality);
    }
}