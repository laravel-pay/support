<?php

namespace LaravelPay\Support\Helpers;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Digit
{
    /**
     * Calculating the factorial of a number.
     */
    public function factorial(int $n = 0): int
    {
        if ($n === 0) {
            return 1;
        }

        return $n * $this->factorial($n - 1);
    }

    /**
     * Converts a number into a short version.
     * eg: 1000 >> 1K.
     */
    public function toShort(float $number, int $precision = 1, string $suffix = null): string
    {
        $length = strlen((string) ((int) $number));
        $length = ceil($length / 3) * 3 + 1;

        $suffix = $this->suffix($length, $suffix);
        $value = $this->rounded($number, $length, $precision);

        return $value.$suffix;
    }

    /**
     * Create short unique identifier from number.
     * Actually using in short URL.
     */
    public function toChars(int $number, string $chars = 'abcdefghijklmnopqrstuvwxyz'): string
    {
        $length = mb_strlen($chars);

        $mod = $number % $length;

        while ($mod > 0 || $number > 0) {
            $result = Str::substr($chars, $mod, 1).($result ?? '');

            $number = ($number - $mod) / $length;

            $mod = $number % $length;
        }

        return $result ?? Str::substr($chars, $number, 1);
    }

    /**
     * Format a number with grouped with divider.
     */
    public function rounded(float|int $number, int $length = 4, int $precision = 1): float
    {
        $divided = (float) bcpow(10, $length - 4, 2);

        return round($number / $divided, $precision);
    }

    /**
     * Converts a numeric value to a string.
     */
    public function toString(float|int $value): string
    {
        return (string) $value;
    }

    protected function suffix(int $length = 0, string $suffix = null): string
    {
        $available = [
            4 => ''.$suffix,
            7 => 'K'.$suffix,
            10 => 'M'.$suffix,
            13 => 'B'.$suffix,
            16 => 'T'.$suffix.'+',
        ];

        return $available[$length] ?? Arr::last($available);
    }
}
