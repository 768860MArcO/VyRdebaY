<?php
// 代码生成时间: 2025-09-20 15:57:02
// Hash Calculator using PHP and ZEND Framework

class HashCalculator {

    private $algorithm = 'sha256'; // 默认哈希算法

    /**
     * 设置哈希算法
     * 
     * @param string $algorithm 哈希算法名称
     */
    private function setHashAlgorithm($algorithm) {
        if (in_array($algorithm, hash_algos())) {
            $this->algorithm = $algorithm;
        } else {
            throw new InvalidArgumentException("Unsupported hash algorithm: {$algorithm}");
        }
    }

    /**
     * 计算哈希值
     * 
     * @param string $data 待计算的数据
     * @return string 计算后的哈希值
     */
    public function calculateHash($data) {
        if (empty($data)) {
            throw new InvalidArgumentException("Data to be hashed cannot be empty.");
        }

        return hash($this->algorithm, $data);
    }

    /**
     * 获取当前哈希算法
     * 
     * @return string 当前使用的哈希算法
     */
    public function getHashAlgorithm() {
        return $this->algorithm;
    }

}

// 示例代码
try {
    $hashCalculator = new HashCalculator();
    $hashCalculator->setHashAlgorithm('sha512'); // 设置哈希算法为 sha512
    $data = "Hello, World!"; // 待计算的数据
    $hashValue = $hashCalculator->calculateHash($data); // 计算哈希值
    echo "Hash Value: " . $hashValue; // 输出哈希值
} catch (Exception $e) {
    echo "Error: " . $e->getMessage(); // 错误处理
}
