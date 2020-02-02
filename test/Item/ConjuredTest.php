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


use App\Item;
use PHPUnit\Framework\TestCase;

final class ConjuredTest extends TestCase
{
    /**
     * @test
     */
    public function whenSellDateIsNotPassed_qualityDegrades(): void
    {
        $item = new Item("foo", 1, 10);
        $standard = new Item\Conjured($item);
        $standard->updateQuality();
        $this->assertEquals(8, $item->quality);
    }
}