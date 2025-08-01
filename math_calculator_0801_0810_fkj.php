<?php
// 代码生成时间: 2025-08-01 08:10:58
class MathCalculator {

    /**
     * Add two numbers
     *
     * @param float $number1
     * @param float $number2
     * @return float
     */
    public function add($number1, $number2) {
        return $number1 + $number2;
    }

    /**
     * Subtract two numbers
     *
     * @param float $number1
     * @param float $number2
     * @return float
     */
    public function subtract($number1, $number2) {
        return $number1 - $number2;
    }

    /**
     * Multiply two numbers
     *
     * @param float $number1
     * @param float $number2
     * @return float
     */
    public function multiply($number1, $number2) {
        return $number1 * $number2;
    }

    /**
     * Divide two numbers
     *
     * @param float $number1
     * @param float $number2
     * @return float
     * @throws Exception if division by zero occurs
     */
    public function divide($number1, $number2) {
        if ($number2 == 0) {
            throw new Exception("Division by zero error.");
        }
        return $number1 / $number2;
    }

    /**
     * Calculate the power of a number
     *
     * @param float $base
     * @param float $exponent
     * @return float
     */
    public function power($base, $exponent) {
        return pow($base, $exponent);
    }

}

// Example usage
try {
    $mathCalculator = new MathCalculator();

    echo "Add: " . $mathCalculator->add(10, 5) . "
";
    echo "Subtract: " . $mathCalculator->subtract(10, 5) . "
";
    echo "Multiply: " . $mathCalculator->multiply(10, 5) . "
";
    echo "Divide: " . $mathCalculator->divide(10, 5) . "
";
    echo "Power: " . $mathCalculator->power(2, 3) . "
";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
