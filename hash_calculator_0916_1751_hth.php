<?php
// 代码生成时间: 2025-09-16 17:51:53
// Using Zend Framework's Hash component
use Zend\Crypt\Hash;

class HashCalculator {
    /**
     * Calculate the hash of a given string
     *
     * @param string $input The string to be hashed
     * @param string $algorithm The hashing algorithm to use (e.g., 'sha256', 'md5', etc.)
     * @return string The calculated hash
     * @throws Exception If the algorithm is not supported
     */
    public function calculateHash($input, $algorithm = 'sha256') {
        // Check if the algorithm is supported
        if (!in_array($algorithm, hash_algos())) {
            throw new Exception("Unsupported hashing algorithm: {$algorithm}");
        }

        // Calculate and return the hash
        return hash($algorithm, $input);
    }
}

// Using the HashCalculator class
try {
    $hashCalculator = new HashCalculator();
    $inputString = "Hello, World!";
    $algorithm = "sha256"; // You can change this to any supported algorithm

    $hash = $hashCalculator->calculateHash($inputString, $algorithm);
    echo "Input: {$inputString}
";
    echo "Hash ({$algorithm}): {$hash}";
} catch (Exception $e) {
    // Error handling
    echo "Error: " . $e->getMessage();
}
