<?php declare(strict_types=1);

namespace App;

/**
 * @author Toni Van de Voorde
 */
final class SellIn
{
    private int $value;

    private function __construct(int $value)
    {
        $this->value = $value;
    }

    public static function valueOf(int $value): SellIn
    {
        return new self($value);
    }

    public function lte(int $value): bool
    {
        return $this->value <= $value;
    }

    public function decrease(): SellIn
    {
        return new SellIn($this->value - 1);
    }

    public function isPassed(): bool
    {
        return $this->value < 0;
    }

    public function asInt(): int
    {
        return $this->value;
    }
}
