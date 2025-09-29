<?php
// 代码生成时间: 2025-09-29 16:49:28
class FeatureEngineeringTool {
# 添加错误处理

    private $data;

    /**
     * Constructor to initialize the data array.
     *
     * @param array $data The dataset to be processed.
     */
    public function __construct($data) {
        $this->data = $data;
    }

    /**
     * Add noise to the dataset to increase its complexity.
     *
     * @param float $noiseLevel The level of noise to add.
     * @return array The dataset with added noise.
     */
    public function addNoise($noiseLevel) {
        if ($noiseLevel < 0 || $noiseLevel > 1) {
            throw new InvalidArgumentException('Noise level must be between 0 and 1.');
        }

        $noisyData = [];
        foreach ($this->data as $key => $value) {
            $noisyData[$key] = $value + ($value * $noiseLevel * (2 * mt_rand() / mt_getrandmax() - 1));
        }

        return $noisyData;
    }

    /**
     * Normalize the dataset to a specified range.
     *
     * @param array $range The range to normalize the data to.
     * @return array The normalized dataset.
     */
# 增强安全性
    public function normalize($range) {
        if (count($range) != 2) {
            throw new InvalidArgumentException('Normalization range must have two elements.');
        }

        $min = min($this->data);
        $max = max($this->data);
        $normalizedData = [];
        foreach ($this->data as $value) {
            $normalizedData[] = ($value - $min) / ($max - $min) * ($range[1] - $range[0]) + $range[0];
        }

        return $normalizedData;
    }

    /**
     * Split the dataset into training and testing sets.
# NOTE: 重要实现细节
     *
     * @param float $testSize The proportion of the dataset to use for testing.
     * @return array An associative array with 'train' and 'test' keys.
# FIXME: 处理边界情况
     */
    public function splitDataset($testSize) {
        if ($testSize < 0 || $testSize > 1) {
            throw new InvalidArgumentException('Test size must be between 0 and 1.');
        }

        $testCount = count($this->data) * $testSize;
# 优化算法效率
        $testData = array_slice($this->data, 0, $testCount);
        $trainData = array_slice($this->data, $testCount);

        return ['train' => $trainData, 'test' => $testData];
    }

    /**
     * Get the original dataset.
     *
     * @return array The original dataset.
     */
    public function getOriginalData() {
        return $this->data;
    }

}

// Usage example
try {
    $data = [/* Your dataset here */];
    $featureTool = new FeatureEngineeringTool($data);
    $noisyData = $featureTool->addNoise(0.1);
    $normalizedData = $featureTool->normalize([0, 1]);
    $datasetSplit = $featureTool->splitDataset(0.2);

    // Output the results
    echo 'Noisy Data: ';
    print_r($noisyData);

    echo 'Normalized Data: ';
    print_r($normalizedData);

    echo 'Dataset Split: ';
    print_r($datasetSplit);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
# 改进用户体验
