<?php declare(strict_types=1);

namespace App\Item;

use App\Name;
use App\Quality;
use App\SellIn;

/**
 * @author Toni Van de Voorde
 */
trait GildedItemTrait
{
    private Name $name;

    private SellIn $sellIn;

    private Quality $quality;

    public function __construct(
        Name $name,
        SellIn $sellIn,
        Quality $quality
    ) {
        $this->name = $name;
        $this->sellIn = $sellIn;
        $this->quality = $quality;
    }

    protected function decreaseSellIn(): void
    {
        $this->sellIn = $this->sellIn->decrease();
    }

    protected function increaseQuality(): void
    {
        $this->quality = $this->quality->increase();
    }

    protected function decreaseQuality(): void
    {
        $decreaseAmount = $this->sellIn->isPassed() ? 2 : 1;
        $this->quality = $this->quality->decrease($decreaseAmount);
    }

    protected function expireQuality(): void
    {
        $this->quality = $this->quality->expired();
    }

    public function quality(): Quality
    {
        return $this->quality;
    }

    public function sellIn(): SellIn
    {
        return $this->sellIn;
    }

    public function name(): Name
    {
        return $this->name;
    }
}
