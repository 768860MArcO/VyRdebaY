<?php
// 代码生成时间: 2025-09-22 04:03:58
// Ensure the autoloader is included and the application is bootstrapped.
use Zend\ModuleManager\ModuleManager;
use Zend\Mvc\Application;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\ServiceManager\ServiceManager;

// Define the module class.
class SecurityAuditLogModule
{
    public function init(ModuleManager $moduleManager)
    {
        // Initialize module.
        $moduleManager->getEventManager()->attach(ModuleEvent::EVENT_DISPATCH, array($this, 'onDispatch'), 100);
    }

    // Listen to the dispatch event to add auditing logic.
    public function onDispatch(MvcEvent $e)
    {
        // Retrieve the request and response from the event.
        $request = $e->getRequest();
        $response = $e->getResponse();

        // Perform the audit action.
        try {
            $this->auditLog($request, $response);
        } catch (Exception $ex) {
            // Handle any exceptions that occur during the audit.
            // Log the exception or handle it as needed.
            error_log($ex->getMessage());
        }
    }

    // The method responsible for creating and writing to the audit log.
    private function auditLog($request, $response)
    {
        // Define the log file path.
        $logFilePath = 'data/security_audit.log';

        // Open the log file in append mode.
        $fileHandle = fopen($logFilePath, 'a');

        if ($fileHandle === false) {
            throw new Exception('Unable to open the log file for writing.');
        }

        // Construct the log message.
        $logMessage = sprintf(
            "[%s] %s %s %s %s %d %d",
            date('Y-m-d H:i:s'),
            $request->getUri()->getHost(),
            $request->getMethod(),
            $request->getUriString(),
            $request->getServer('HTTP_REFERER', 'Direct Request'),
            $response->getStatusCode(),
            $response->getContentLength()
        );

        // Write the log message to the file.
        fwrite($fileHandle, $logMessage . PHP_EOL);

        // Close the log file.
        fclose($fileHandle);
    }
}
