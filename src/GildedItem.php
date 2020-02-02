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

namespace App;

interface GildedItem
{
    public function updateQuality(): void;

    public function quality(): int;

    public function sellIn(): int;
}
