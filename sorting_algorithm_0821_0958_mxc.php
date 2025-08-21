<?php
// 代码生成时间: 2025-08-21 09:58:04
class SortingAlgorithm {

    /**
     * Sort an array using bubble sort algorithm.
     *
     * @param array $array The array to be sorted.
     * @return array The sorted array.
     */
    public function bubbleSort(array $array): array {
        // Error handling for non-array input
        if (!is_array($array)) {
            throw new InvalidArgumentException('Input must be an array.');
        }

        $n = count($array);
        for ($i = 0; $i < $n - 1; $i++) {
            for ($j = 0; $j < $n - $i - 1; $j++) {
                if ($array[$j] > $array[$j + 1]) {
                    // Swap the elements
                    $temp = $array[$j];
                    $array[$j] = $array[$j + 1];
                    $array[$j + 1] = $temp;
                }
            }
        }

        return $array;
    }

    /**
     * Sort an array using quick sort algorithm.
     *
     * @param array $array The array to be sorted.
     * @return array The sorted array.
     */
    public function quickSort(array $array): array {
        // Base case, if array has one or zero elements, it is already sorted
        if (count($array) < 2) {
            return $array;
        }

        // Use first element as pivot for recursive calls
        $pivotKey = key($array);
        $pivot = array_shift($array);
        $less = $greater = [];

        foreach ($array as $item) {
            if ($item <= $pivot) {
                $less[] = $item;
            } else {
                $greater[] = $item;
            }
        }

        // Recursive calls and merge results
        return array_merge(
            $this->quickSort($less),
            [$pivotKey => $pivot],
            $this->quickSort($greater)
        );
    }

    /**
     * Sort an array using insertion sort algorithm.
     *
     * @param array $array The array to be sorted.
     * @return array The sorted array.
     */
    public function insertionSort(array $array): array {
        for ($i = 1; $i < count($array); $i++) {
            $key = $array[$i];
            $j = $i - 1;

            while ($j >= 0 && $array[$j] > $key) {
                $array[$j + 1] = $array[$j];
                $j--;
            }
            $array[$j + 1] = $key;
        }

        return $array;
    }

}

// Example usage
try {
    $sortingAlgorithm = new SortingAlgorithm();
    $unsortedArray = [3, 2, 5, 1, 4];
    $sortedArray = $sortingAlgorithm->bubbleSort($unsortedArray);
    print_r($sortedArray);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}