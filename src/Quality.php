<?php declare(strict_types=1);

namespace App;

use Webmozart\Assert\Assert;

/**
 * @author Toni Van de Voorde
 */
final class Quality
{
    private int $value;

    /**
     * The max quality value to not exceed.
     */
    private int $max;

    private function __construct(int $value, int $max)
    {
        if ($value > $max) {
            throw new \InvalidArgumentException(sprintf(
                'The given value %d cannot be greater than the max value %s',
                $value,
                $max
            ));
        }

        $this->value = $value < 0 ? 0 : $value;

        Assert::greaterThan($max, 0);
        $this->max = $max;
    }

    public static function valueOf(int $value, int $max): Quality
    {
        return new Quality($value, $max);
    }

    /**
     * Checks if the current quality value is less then the new given value.
     *
     * @param int $quality
     *
     * @return bool
     */
    public function lt(int $quality): bool
    {
        return $this->value < $quality;
    }

    public function increase(): Quality
    {
        $increase = $this->lt($this->max) ? 1 : 0;
        return new self($this->value + $increase, $this->max);
    }

    public function decrease(int $amount = 1): Quality
    {
        return new self($this->value - $amount, $this->max);
    }

    public function expired(): Quality
    {
        return new self(0, $this->max);
    }

    public function asInt(): int
    {
        return $this->value;
    }
}
