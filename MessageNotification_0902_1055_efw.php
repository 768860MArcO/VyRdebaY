<?php
// 代码生成时间: 2025-09-02 10:55:49
class MessageNotification {

    /**
     * @var array List of listeners for the message notification event.
     */
    private $listeners = [];

    /**
     * Add a listener to the message notification event.
     *
     * @param callable $listener The listener to add.
     */
    public function attachListener(callable $listener) {
        $this->listeners[] = $listener;
    }

    /**
     * Notify all listeners with the given message.
     *
     * @param string $message The message to be notified.
     */
    public function notify(string $message) {
        foreach ($this->listeners as $listener) {
            try {
                call_user_func($listener, $message);
            } catch (Exception $e) {
                // Handle any errors that occur during notification.
                error_log('Error notifying listener: ' . $e->getMessage());
            }
        }
    }

    /**
     * Remove a listener from the message notification event.
     *
     * @param callable $listener The listener to remove.
     */
    public function detachListener(callable $listener) {
        $this->listeners = array_filter($this->listeners, function ($l) use ($listener) {
            return $l !== $listener;
        });
    }
}

// Usage example
// $notification = new MessageNotification();
// $notification->attachListener(function ($message) {
//     echo 'Listener 1 received message: ' . $message . PHP_EOL;
// });
// $notification->attachListener(function ($message) {
//     echo 'Listener 2 received message: ' . $message . PHP_EOL;
// });
// $notification->notify('Hello, this is a test message!');
