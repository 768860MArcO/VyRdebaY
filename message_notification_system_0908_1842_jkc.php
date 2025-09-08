<?php
// 代码生成时间: 2025-09-08 18:42:42
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Select;
use Zend\Db\TableGateway\AbstractTableGateway;

class MessageNotificationSystem extends AbstractTableGateway
{
    /**
     * @var AdapterInterface
     */
    protected $adapter;

    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
        $this->table = 'notifications';
        $this->initialize();
    }

    /**
     * Send a notification to a user or group
     *
     * @param array $data
     * @return bool
     */
    public function sendNotification(array $data)
    {
        try {
            // Validate input data
            if (empty($data['message']) || empty($data['recipient_id'])) {
                throw new \Exception('Invalid notification data');
            }

            // Create a new notification
            $notification = array(
                'message' => $data['message'],
                'recipient_id' => $data['recipient_id'],
                'sender_id' => $data['sender_id'],
                'created_at' => date('Y-m-d H:i:s')
            );

            // Insert the notification into the database
            $this->insert($notification);

            return true;
        } catch (\Exception $e) {
            // Handle any exceptions
            error_log($e->getMessage());
            return false;
        }
    }

    /**
     * Fetch all notifications for a user
     *
     * @param int $userId
     * @return array
     */
    public function fetchNotificationsForUser($userId)
    {
        try {
            // Create a new Select object
            $select = new Select($this->table);
            $select->where(array('recipient_id' => $userId));
            $select->order('created_at DESC');

            // Create a new Sql object
            $sql = new Sql($this->adapter);

            // Prepare the statement for execution
            $statement = $sql->prepareStatementForSqlObject($select);
            $result = $statement->execute();

            // Fetch the results
            $results = $result->toArray();

            return $results;
        } catch (\Exception $e) {
            // Handle any exceptions
            error_log($e->getMessage());
            return array();
        }
    }
}
