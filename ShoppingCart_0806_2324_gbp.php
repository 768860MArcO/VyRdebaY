<?php
// 代码生成时间: 2025-08-06 23:24:39
class ShoppingCart {

    private $items;
    private $total;

    /**
     * Constructor
     *
     * Initialize the shopping cart with an empty array of items.
     */
    public function __construct() {
        $this->items = array();
        $this->total = 0;
    }

    /**
     * Add an item to the cart.
     *
     * @param array $item Item array containing 'id' and 'price' keys.
     * @return void
     * @throws Exception If item data is invalid.
     */
    public function addItem(array $item) {
        if (!isset($item['id'], $item['price']) || !is_numeric($item['price'])) {
            throw new Exception('Invalid item data provided.');
        }

        $this->items[$item['id']] = $item;
        $this->total += $item['price'];
    }

    /**
     * Remove an item from the cart.
     *
     * @param int $itemId The ID of the item to remove.
     * @return void
     * @throws Exception If the item is not found in the cart.
     */
    public function removeItem($itemId) {
        if (!isset($this->items[$itemId])) {
            throw new Exception('Item not found in the cart.');
        }

        unset($this->items[$itemId]);
        $this->total -= $this->items[$itemId]['price'];
    }

    /**
     * List all items in the cart.
     *
     * @return array An array of items in the cart.
     */
    public function listItems() {
        return $this->items;
    }

    /**
     * Get the total price of items in the cart.
     *
     * @return float The total price of items in the cart.
     */
    public function getTotal() {
        return $this->total;
    }

}
