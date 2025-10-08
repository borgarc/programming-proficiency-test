<?php

namespace App;

class Bakery
{
    /**
     * Calculate the output of cakes for a giver recipe
     *
     * @param array $recipe      Contains the necessary ingredients to make one cake
     * @param array $ingredients Contains the amount of ingredients you have available to bake
     *
     * @return int The number of cakes you can bake
     */
    public static function calculateOutput(array $recipe, array $ingredients): int
    {
        $numberOfCakes = 0;

        // Complete the function

        foreach ($recipe as $key => $needed) {
            // Missing ingredient → return 0
            if (!array_key_exists($key, $ingredients) || $ingredients[$key] < $needed) {
                return 0;
            }

            $possible = intdiv($ingredients[$key], $needed);

            if ($numberOfCakes === 0) {
                // First ingredient → set initial value
                $numberOfCakes = $possible;
            } else {
                // Limit by the smallest possible number of cakes
                $numberOfCakes = min($numberOfCakes, $possible);
            }
        }

        return $numberOfCakes;
    }
}