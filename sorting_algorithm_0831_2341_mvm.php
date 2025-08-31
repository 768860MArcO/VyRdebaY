<?php
// 代码生成时间: 2025-08-31 23:41:26
class SortingAlgorithm {

    /**
     * Bubble Sort algorithm.
     * @param array $array The array to be sorted.
     * @return array The sorted array.
     */
    public function bubbleSort(array $array) {
        for ($i = 0; $i < count($array); $i++) {
            $swapped = false;
            for ($j = 0; $j < count($array) - $i - 1; $j++) {
                if ($array[$j] > $array[$j + 1]) {
                    $temp = $array[$j];
                    $array[$j] = $array[$j + 1];
                    $array[$j + 1] = $temp;
                    $swapped = true;
                }
            }
            // If no elements were swapped, the array is sorted.
            if (!$swapped) break;
        }
        return $array;
    }

    /**
     * Selection Sort algorithm.
     * @param array $array The array to be sorted.
     * @return array The sorted array.
     */
    public function selectionSort(array $array) {
        for ($i = 0; $i < count($array) - 1; $i++) {
            $min = $i;
            for ($j = $i + 1; $j < count($array); $j++) {
                if ($array[$j] < $array[$min]) {
                    $min = $j;
                }
            }
            if ($min != $i) {
                $temp = $array[$i];
                $array[$i] = $array[$min];
                $array[$min] = $temp;
            }
        }
        return $array;
    }

    /**
     * Insertion Sort algorithm.
     * @param array $array The array to be sorted.
     * @return array The sorted array.
     */
    public function insertionSort(array $array) {
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
     * Driver function to test sorting algorithms.
     * @param array $array The array to be sorted.
     */
    public function testSorting(array $array) {
        try {
            $sortedArrayBubble = $this->bubbleSort($array);
            echo "Bubble Sort:
";
            print_r($sortedArrayBubble);

            $sortedArraySelection = $this->selectionSort($array);
            echo "Selection Sort:
";
            print_r($sortedArraySelection);

            $sortedArrayInsertion = $this->insertionSort($array);
            echo "Insertion Sort:
";
            print_r($sortedArrayInsertion);

        } catch (Exception $e) {
            // Error handling
            echo "Error: " . $e->getMessage();
        }
    }

}

// Usage
$array = array(64, 34, 25, 12, 22, 11, 90);
$sortingAlgorithm = new SortingAlgorithm();
$sortingAlgorithm->testSorting($array);
