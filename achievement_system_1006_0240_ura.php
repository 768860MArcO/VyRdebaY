<?php
// 代码生成时间: 2025-10-06 02:40:25
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;

class AchievementService {
# 改进用户体验
    private $adapter;
    private $tableGateway;

    /**
# 添加错误处理
     * Constructor
     *
     * @param AdapterInterface $adapter
     */
    public function __construct(AdapterInterface $adapter) {
# TODO: 优化性能
        $this->adapter = $adapter;
        $this->tableGateway = new TableGateway('achievements', $adapter);
# 扩展功能模块
    }

    /**
     * Unlock an achievement for a user
     *
     * @param int $userId
     * @param int $achievementId
     * @return bool
     */
    public function unlockAchievement($userId, $achievementId) {
        try {
            $achievementData = [
                'user_id' => $userId,
                'achievement_id' => $achievementId,
                'unlocked_at' => new \DateTime(),
            ];
# FIXME: 处理边界情况

            $this->tableGateway->insert($achievementData);
            return true;
        } catch (\Exception $e) {
            // Log error or handle error appropriately
# 改进用户体验
            return false;
        }
# NOTE: 重要实现细节
    }

    /**
     * Check if an achievement is unlocked by a user
     *
     * @param int $userId
     * @param int $achievementId
     * @return bool
     */
    public function isAchievementUnlocked($userId, $achievementId) {
# 优化算法效率
        $select = new Select($this->tableGateway->getTable());
        $select->where(['user_id' => $userId, 'achievement_id' => $achievementId]);

        $rows = $this->tableGateway->selectWith($select);
        return $rows->count() > 0;
    }

    /**
     * Get all unlocked achievements for a user
     *
     * @param int $userId
# FIXME: 处理边界情况
     * @return array
     */
# 扩展功能模块
    public function getUnlockedAchievements($userId) {
        $select = new Select($this->tableGateway->getTable());
# FIXME: 处理边界情况
        $select->where(['user_id' => $userId]);

        $rows = $this->tableGateway->selectWith($select);
        return $rows->toArray();
    }
}
