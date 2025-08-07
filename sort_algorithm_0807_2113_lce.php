<?php
// 代码生成时间: 2025-08-07 21:13:26
 * This class provides a simple interface for various sorting algorithms.
 * It is designed to be easily understandable, maintainable, and extensible.
 *
 * @author Your Name
 * @version 1.0
 */
class SortAlgorithm {

    /**
     * Sorts an array using bubble sort algorithm.
     *
     * @param array $array The array to be sorted.
     * @return array The sorted array.
     */
    public function bubbleSort(array $array): array {
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
     * Sorts an array using selection sort algorithm.
     *
     * @param array $array The array to be sorted.
     * @return array The sorted array.
     */
    public function selectionSort(array $array): array {
        $n = count($array);
        for ($i = 0; $i < $n - 1; $i++) {
            // Find the minimum element in unsorted array
            $minIndex = $i;
            for ($j = $i + 1; $j < $n; $j++) {
                if ($array[$j] < $array[$minIndex]) {
                    $minIndex = $j;
                }
            }
            // Swap the found minimum element with the first element
            $temp = $array[$minIndex];
            $array[$minIndex] = $array[$i];
            $array[$i] = $temp;
        }
        return $array;
    }

    /**
     * Sorts an array using insertion sort algorithm.
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

    /**
     * Sorts an array using quick sort algorithm.
     *
     * @param array $array The array to be sorted.
     * @return array The sorted array.
     */
    public function quickSort(array $array): array {
        if (count($array) < 2) {
            return $array;
        }
        $left = $right = array();
        $pivot = array_shift($array);
        foreach ($array as $item) {
            if ($item <= $pivot) {
                $left[] = $item;
            } else {
                $right[] = $item;
            }
        }
        return array_merge($this->quickSort($left), array($pivot), $this->quickSort($right));
    }

    /**
     * Sorts an array using merge sort algorithm.
     *
     * @param array $array The array to be sorted.
     * @return array The sorted array.
     */
    public function mergeSort(array $array): array {
        if (count($array) == 1) return $array;
        $mid = count($array) / 2;
        $left = array_slice($array, 0, $mid);
        $right = array_slice($array, $mid);
        return $this->merge($this->mergeSort($left), $this->mergeSort($right));
    }

    /**
     * Merges two sorted arrays.
     *
     * @param array $left The left sorted array.
     * @param array $right The right sorted array.
     * @return array The merged sorted array.
     */
    private function merge(array $left, array $right): array {
        $result = array();
        $leftCount = count($left);
        $rightCount = count($right);
        $i = $j = 0;
        while ($i < $leftCount && $j < $rightCount) {
            if ($left[$i] < $right[$j]) {
                $result[] = $left[$i++];
            } else {
                $result[] = $right[$j++];
            }
        }
        while ($i < $leftCount) $result[] = $left[$i++];
        while ($j < $rightCount) $result[] = $right[$j++];
        return $result;
    }

}

// Example usage:
$sort = new SortAlgorithm();
$array = array(64, 34, 25, 12, 22, 11, 90);

echo "Before sorting:
";
print_r($array);

$sortedArray = $sort->quickSort($array);

echo "After sorting using quick sort:
";
print_r($sortedArray);
