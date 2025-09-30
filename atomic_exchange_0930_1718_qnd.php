<?php
// 代码生成时间: 2025-09-30 17:18:49
// AtomicExchange.php

/**
 * 实现原子交换协议的类。
 * 使用Zend框架的锁机制来确保操作的原子性。
 */
class AtomicExchange {

    private $lockName;
    private $value;
    private $mutex;

    /**
     * 构造函数。
     * 初始化锁名称和值。
     *
     * @param string $lockName 锁的名称。
     * @param mixed $initialValue 初始值。
     */
    public function __construct($lockName, $initialValue) {
        $this->lockName = $lockName;
        $this->value = $initialValue;
        $this->mutex = new Zend_Lock(Zend_Lock::LOCK_MUTEX);
    }

    /**
     * 执行原子交换。
     *
     * @param mixed $newValue 新值。
     * @return mixed 返回旧值。
     */
    public function exchange($newValue) {
        if (!$this->mutex->acquire()) {
            // 无法获取锁，抛出异常。
            throw new Exception("Unable to acquire lock.");
        }

        try {
            $oldValue = $this->value;
            $this->value = $newValue;
            return $oldValue;
        } finally {
            // 确保释放锁。
            $this->mutex->release();
        }
    }

    /**
     * 获取当前值。
     *
     * @return mixed 当前值。
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * 设置新值。
     *
     * @param mixed $newValue 新值。
     */
    public function setValue($newValue) {
        $this->value = $newValue;
    }
}

// 使用示例:
try {
    $exchange = new AtomicExchange('my_lock', 0);
    $oldValue = $exchange->exchange(10);
    echo "Old value: " . $oldValue . "
";
    echo "New value: " . $exchange->getValue() . "
";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "
";
}
