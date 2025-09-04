<?php
// 代码生成时间: 2025-09-04 15:55:53
class RandomNumberGenerator {

    /**
     * Generates a random number within the specified range.
     * 
     * @param int $min The minimum value of the range.
     * @param int $max The maximum value of the range.
     * @return int The generated random number.
     * @throws InvalidArgumentException If the minimum or maximum value is invalid.
     */
    public function generateRandomNumber($min, $max) {
        // Check if the minimum and maximum values are valid
        if ($min > $max) {
            throw new InvalidArgumentException('Minimum value cannot be greater than maximum value.');
        }

        // Check if the values are integers
        if (!is_int($min) || !is_int($max)) {
            throw new InvalidArgumentException('Minimum and maximum values must be integers.');
        }

        // Generate and return a random number between the specified range
        return rand($min, $max);
    }

}

// Example usage:
try {
    $generator = new RandomNumberGenerator();
    $randomNumber = $generator->generateRandomNumber(1, 100);
    echo "Random number generated: {$randomNumber}";
} catch (InvalidArgumentException $e) {
    echo "Error: " . $e->getMessage();
}