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

final class BackstagePassTest extends TestCase
{
    /**
     * @test
     * @dataProvider backstagePassesSellInAndQualityExamples
     * @param int $sellIn
     * @param int $quality
     * @param int $expectedRemainingQuality
     */
    public function backstagePasses_increasesDifferentlyDependingOnRemainingSellInDays(
        int $sellIn,
        int $quality,
        int $expectedRemainingQuality
    ): void {
        $item = new Item("Backstage passes to a TAFKAL80ETC concert", $sellIn, $quality);
        $backstagePass = new Item\BackstagePass($item);
        $backstagePass->updateQuality();
        $this->assertEquals($expectedRemainingQuality, $backstagePass->quality());
    }

    /**
     * @return array<array>
     */
    public function backstagePassesSellInAndQualityExamples(): array
    {
        return [
            [20, 10, 11],
            [10, 10, 12],
            [6, 10, 12],
            [5, 10, 13],
            [0, 10, 0],
        ];
    }
}