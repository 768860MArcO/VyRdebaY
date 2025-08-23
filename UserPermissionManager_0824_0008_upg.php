<?php
// 代码生成时间: 2025-08-24 00:08:07
// UserPermissionManager.php
// 描述: 用户权限管理系统，使用ZEND框架实现。

namespace ZendApplication\Module\User;

use Zend\ModuleManager\ModuleManager;
use Zend\ModuleManager\ModuleEvent;
use Zend\ModuleManager\ModuleInterface;
use Zend\ModuleManager\ModuleManagerInterface;
use Zend\Db\TableGateway\TableGatewayInterface;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;

class UserPermissionManager implements ModuleInterface
{
    // @var AdapterInterface
    private $adapter;

    public function init(ModuleManager $moduleManager)
    {
        // 初始化模块时注册事件
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();
        $sharedEvents->attach('*', ModuleEvent::EVENT_DISPATCH, [$this, 'checkPermission'], 100);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function checkPermission(MvcEvent $event)
    {
        $routeMatch = $event->getRouteMatch();
        $controller = $routeMatch->getParam('controller');
        $action = $routeMatch->getParam('action');

        $permissions = $this->getPermissions();

        if (!$this->hasPermission($controller, $action, $permissions)) {
            $response = $event->getResponse();
            $response->setStatusCode(403);
            $response->setContent('You do not have permission to access this page.');
            $event->stopPropagation();
        }
    }

    public function getPermissions()
    {
        // 这里应该从数据库或配置文件中获取权限数据
        // 假设我们有一个简单的权限数组
        return [
            'UserController' => [
                'index' => 'user.index',
                'edit' => 'user.edit',
                'delete' => 'user.delete'
            ],
            'ProductController' => [
                'index' => 'product.index',
                'edit' => 'product.edit',
                'delete' => 'product.delete'
            ],
        ];
    }

    public function hasPermission($controller, $action, $permissions)
    {
        // 检查用户是否具有执行特定操作的权限
        // 这里应该根据实际情况实现权限检查逻辑
        // 例如，可以检查用户的Role或Permission
        return isset($permissions[$controller]) && isset($permissions[$controller][$action]);
    }
}
