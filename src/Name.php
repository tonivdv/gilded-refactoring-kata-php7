<?php declare(strict_types=1);

namespace App;

use Webmozart\Assert\Assert;

/**
 * @author Toni Van de Voorde
 */
final class Name
{
    private string $value;

    private function __construct(string $value)
    {
        Assert::notEmpty($value);
        $this->value = $value;
    }

    public static function valueOf(string $value): Name
    {
        return new self($value);
    }

    public function asString(): string
    {
        return $this->value;
    }
}
