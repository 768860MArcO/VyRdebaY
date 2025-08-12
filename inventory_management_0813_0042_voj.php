<?php
// 代码生成时间: 2025-08-13 00:42:49
// Use autoloader from Zend Framework
require_once 'vendor/autoload.php';

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Sql;

class InventoryManager {
    /**
     * Database adapter
     *
     * @var Adapter
     */
    private $dbAdapter;

    /**
     * Constructor
     *
     * @param Adapter $dbAdapter
     */
    public function __construct(Adapter $dbAdapter) {
        $this->dbAdapter = $dbAdapter;
    }

    /**
     * Get inventory items
     *
     * @return ResultSet
     */
    public function getInventoryItems() {
        $inventoryTable = new TableGateway('inventory', $this->dbAdapter, null, new ResultSet());
        return $inventoryTable->select();
    }

    /**
     * Add a new inventory item
     *
     * @param array $data
     * @return bool
     */
    public function addItem($data) {
        $inventoryTable = new TableGateway('inventory', $this->dbAdapter, null, new ResultSet());
        try {
            $inventoryTable->insert($data);
            return true;
        } catch (Exception $e) {
            // Handle error
            echo 'Error adding item: ' . $e->getMessage();
            return false;
        }
    }

    /**
     * Update an inventory item
     *
     * @param array $data
     * @param int $itemId
     * @return bool
     */
    public function updateItem($data, $itemId) {
        $inventoryTable = new TableGateway('inventory', $this->dbAdapter, null, new ResultSet());
        try {
            $inventoryTable->update($data, ['item_id' => $itemId]);
            return true;
        } catch (Exception $e) {
            // Handle error
            echo 'Error updating item: ' . $e->getMessage();
            return false;
        }
    }

    /**
     * Delete an inventory item
     *
     * @param int $itemId
     * @return bool
     */
    public function deleteItem($itemId) {
        $inventoryTable = new TableGateway('inventory', $this->dbAdapter, null, new ResultSet());
        try {
            $inventoryTable->delete(['item_id' => $itemId]);
            return true;
        } catch (Exception $e) {
            // Handle error
            echo 'Error deleting item: ' . $e->getMessage();
            return false;
        }
    }
}

// Usage example
$dbAdapter = new Adapter($dsn);
$inventoryManager = new InventoryManager($dbAdapter);

// Get inventory items
$items = $inventoryManager->getInventoryItems();
foreach ($items as $item) {
    echo 'Item ID: ' . $item['item_id'] . ' | Name: ' . $item['name'] . ' | Quantity: ' . $item['quantity'] . "
";
}

// Add a new item
$newItem = [
    'name' => 'New Item',
    'quantity' => 100
];
$inventoryManager->addItem($newItem);

// Update an existing item
$updateItem = [
    'quantity' => 150
];
$inventoryManager->updateItem($updateItem, 1);

// Delete an item
$inventoryManager->deleteItem(2);

?>