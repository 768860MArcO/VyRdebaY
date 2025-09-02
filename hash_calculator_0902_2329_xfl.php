<?php
// 代码生成时间: 2025-09-02 23:29:21
class HashCalculator {

    private $algorithm;
    private $data;

    /**
     * Constructor for HashCalculator
     *
     * @param string $algorithm The hash algorithm to use (e.g., 'md5', 'sha256')
     * @param mixed $data The data to hash
     */
    public function __construct($algorithm, $data) {
        $this->algorithm = $algorithm;
        $this->data = $data;
    }

    /**
     * Calculate hash
     *
     * @return string The calculated hash
     */
    public function calculate() {
        if (!in_array($this->algorithm, hash_algos(), true)) {
            throw new InvalidArgumentException("Unsupported algorithm: {$this->algorithm}.");
        }

        return hash($this->algorithm, $this->data);
    }

    /**
     * Set the algorithm for hashing
     *
     * @param string $algorithm
     */
    public function setAlgorithm($algorithm) {
        $this->algorithm = $algorithm;
    }

    /**
     * Set the data to be hashed
     *
     * @param mixed $data
     */
    public function setData($data) {
        $this->data = $data;
    }
}

// Example usage
try {
    $calculator = new HashCalculator('sha256', 'Hello, World!');
    echo "The hash is: " . $calculator->calculate();
} catch (InvalidArgumentException $e) {
    echo "Error: " . $e->getMessage();
}
