<?php

namespace App\Tests;

use App\SellIn;
use PHPUnit\Framework\TestCase;

/**
 * @author Toni Van de Voorde
 */
final class SellInTest extends TestCase
{
    /**
     * @test
     */
    public function decrease_shouldDecreaseTheSellIn(): void
    {
        $sellIn = SellIn::valueOf(10)->decrease();
        $this->assertEquals(SellIn::valueOf(9), $sellIn);
    }
}