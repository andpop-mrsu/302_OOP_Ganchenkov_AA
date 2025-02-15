<?php

declare(strict_types=1);

class Fraction
{
    private int $numer;
    private int $denom;

    public function __construct(int $numer, int $denom)
    {
        if ($denom === 0) {
            throw new InvalidArgumentException("Denominator cannot be zero.");
        }

        $gcd = $this->gcd(abs($numer), abs($denom));
        $this->numer = $numer / $gcd;
        $this->denom = $denom / $gcd;

        if ($this->denom < 0) {
            $this->numer *= -1;
            $this->denom *= -1;
        }
    }

    public function getNumer(): int
    {
        return $this->numer;
    }

    public function getDenom(): int
    {
        return $this->denom;
    }

    public function add(Fraction $frac): Fraction
    {
        $newNumer = $this->numer * $frac->getDenom() + $frac->getNumer() * $this->denom;
        $newDenom = $this->denom * $frac->getDenom();
        return new Fraction($newNumer, $newDenom);
    }

    public function sub(Fraction $frac): Fraction
    {
        $newNumer = $this->numer * $frac->getDenom() - $frac->getNumer() * $this->denom;
        $newDenom = $this->denom * $frac->getDenom();
        return new Fraction($newNumer, $newDenom);
    }

    public function __toString(): string
    {
        $whole = intdiv($this->numer, $this->denom);
        $remainder = abs($this->numer % $this->denom);

        if ($remainder === 0) {
            return (string) $whole;
        }

        if ($whole === 0) {
            return "{$this->numer}/{$this->denom}";
        }

        return "{$whole}`{$remainder}/{$this->denom}";
    }

    private function gcd(int $a, int $b): int
    {
        return $b === 0 ? $a : $this->gcd($b, $a % $b);
    }
}
