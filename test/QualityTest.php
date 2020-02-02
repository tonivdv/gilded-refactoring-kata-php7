<?php

namespace App\Tests;

use App\Quality;
use PHPUnit\Framework\TestCase;

/**
 * @author Toni Van de Voorde
 */
final class QualityTest extends TestCase
{
    /**
     * @test
     */
    public function increase_shouldIncreaseTheQuality(): void
    {
        $quality = Quality::valueOf(10, 50)->increase();
        $this->assertEquals(Quality::valueOf(11, 50), $quality);
    }

    /**
     * @test
     */
    public function decrease_shouldDecreaseTheQuality(): void
    {
        $quality = Quality::valueOf(10, 50)->decrease();
        $this->assertEquals(Quality::valueOf(9, 50), $quality);
    }
}