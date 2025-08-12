<?php
// 代码生成时间: 2025-08-12 18:03:14
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;

class ItemController extends AbstractRestfulController
{
    // Assuming ItemService is a service class handling business logic
    private $service;

    public function __construct(ItemService $service)
    {
        $this->service = $service;
    }

    /**
     * Retrieve a list of items.
     *
     * @return JsonModel
     */
    public function getList()
    {
        try {
            $items = $this->service->getAllItems();
            return new JsonModel($items);
        } catch (Exception $e) {
            // Handle errors and return a proper error response
            return new JsonModel(array(
                'error' => 'Unable to retrieve items',
                'message' => $e->getMessage()
            ));
        }
    }

    /**
     * Retrieve a single item.
     *
     * @param  mixed $id
     * @return JsonModel
     */
    public function get($id)
    {
        try {
            $item = $this->service->getItemById($id);
            if (!$item) {
                return new JsonModel(array(
                    'error' => 'Item not found'
                ));
            }
            return new JsonModel($item);
        } catch (Exception $e) {
            return new JsonModel(array(
                'error' => 'Error retrieving item',
                'message' => $e->getMessage()
            ));
        }
    }

    /**
     * Create a new item.
     *
     * @param  mixed $data
     * @return JsonModel
     */
    public function create($data)
    {
        try {
            $item = $this->service->createItem($data);
            return new JsonModel($item);
        } catch (Exception $e) {
            return new JsonModel(array(
                'error' => 'Error creating item',
                'message' => $e->getMessage()
            ));
        }
    }

    /**
     * Update an existing item.
     *
     * @param  mixed $id
     * @param  mixed $data
     * @return JsonModel
     */
    public function update($id, $data)
    {
        try {
            $item = $this->service->updateItem($id, $data);
            if (!$item) {
                return new JsonModel(array(
                    'error' => 'Item not found'
                ));
            }
            return new JsonModel($item);
        } catch (Exception $e) {
            return new JsonModel(array(
                'error' => 'Error updating item',
                'message' => $e->getMessage()
            ));
        }
    }

    /**
     * Delete an item.
     *
     * @param  mixed $id
     * @return JsonModel
     */
    public function delete($id)
    {
        try {
            $result = $this->service->deleteItem($id);
            return new JsonModel(array(
                'success' => $result ? 'Item deleted' : 'Item not found'
            ));
        } catch (Exception $e) {
            return new JsonModel(array(
                'error' => 'Error deleting item',
                'message' => $e->getMessage()
            ));
        }
    }
}
