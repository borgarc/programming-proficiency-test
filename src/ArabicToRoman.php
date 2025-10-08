<?php

namespace App;

use InvalidArgumentException;

class ArabicToRoman
{
    /**
     * Receive an arabic number and return a string with its roman counterpart
     *
     * @param int $arabicNumber Arabic number to be transformed (e.g. 121)
     *
     * @return string The roman number equivalent (e.g. CXXI)
     */
    public static function transform(int $arabicNumber): string
    {
        $romanNumber = '';

        // Complete the function

        if ($arabicNumber < 1 || $arabicNumber > 3999) {
            throw new InvalidArgumentException('Number must be between 1 and 3999');
        }

        $map = [
            'M'  => 1000,
            'CM' => 900,
            'D'  => 500,
            'CD' => 400,
            'C'  => 100,
            'XC' => 90,
            'L'  => 50,
            'XL' => 40,
            'X'  => 10,
            'IX' => 9,
            'V'  => 5,
            'IV' => 4,
            'I'  => 1,
        ];

        foreach ($map as $roman => $value) {
            // Find how many times this symbol fits into the number
            $count = intdiv($arabicNumber, $value);
            if ($count) {
                $romanNumber .= str_repeat($roman, $count);
                $arabicNumber %= $value;
            }
        }

        return $romanNumber;
    }
}