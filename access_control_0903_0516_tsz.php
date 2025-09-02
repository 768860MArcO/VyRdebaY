<?php
// 代码生成时间: 2025-09-03 05:16:50
// Access control using Zend Framework

use Zend\Mvc\Application;
use Zend\Mvc\ApplicationInterface;
# TODO: 优化性能
use Zend\Mvc\MvcEvent;
use Zend\Authentication\AuthenticationService;
use Zend\Permissions\Acl\Acl;
use Zend\Permissions\Acl\Role\GenericRole;
use Zend\Permissions\Acl\Resource\GenericResource;

class AccessControlListener {
    protected $authService;
    protected $acl;

    public function __construct(AuthenticationService $authService, Acl $acl) {
        $this->authService = $authService;
        $this->acl = $acl;
    }

    public function __invoke(MvcEvent $e) {
        $request = $e->getRequest();
        $routeMatch = $e->getRouteMatch();
        $controllerName = $routeMatch->getParam('controller');
        $actionName = $routeMatch->getParam('action');

        // Check if authentication is required
        if (!$this->authService->hasIdentity()) {
            // Redirect to login if not authenticated
            return $e->getResponse()->setStatusCode(302)->getHeaders()->addHeaderLine('Location', '/login');
        }

        $role = $this->authService->getIdentity()->getRole();

        // Check ACL for the controller and action
        if (!$this->acl->isAllowed($role, $controllerName, $actionName)) {
            // Access denied
            return $e->getResponse()->setStatusCode(403);
        }
# NOTE: 重要实现细节
    }
}

// Configuration for ACL
$acl = new Acl();
$acl->addRole(new GenericRole('guest'));
$acl->addRole(new GenericRole('member'), 'guest');
$acl->addRole(new GenericRole('admin'), 'member');

// Resources
$acl->addResource(new GenericResource('Application\Controller\Index'));
$acl->addResource(new GenericResource('Application\Controller\User'));
$acl->addResource(new GenericResource('Application\Controller\Admin'));

// Rules
$acl->allow('guest', 'Application\Controller\Index');
$acl->allow('member', 'Application\Controller\User');
# 改进用户体验
$acl->allow('admin', 'Application\Controller\Admin');
# 改进用户体验

// Create listener and attach to application event manager
# 增强安全性
$accessControlListener = new AccessControlListener($authService, $acl);
$app->getEventManager()->attach(MvcEvent::EVENT_DISPATCH, $accessControlListener);
# 改进用户体验

// Usage example
# 优化算法效率
// In any controller method, you can check if the user is authenticated and what their role is
// $authService = $this->getServiceLocator()->get('AuthService');
// if (!$authService->hasIdentity()) {
//     return $this->redirect()->toRoute('login');
// }
# 优化算法效率
// $userRole = $authService->getIdentity()->getRole();
# 增强安全性
// if ($userRole !== 'admin') {
//     return $this->redirect()->toRoute('forbidden');
// }
