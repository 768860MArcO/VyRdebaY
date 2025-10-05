<?php
// 代码生成时间: 2025-10-05 22:17:52
// Ensure that autoload is included to use Zend's components
require_once 'vendor/autoload.php';

use Zend\Escaper\Escaper;

class XssProtection {
    /**
     * @var Escaper
     */
    private $escaper;

    /**
     * Constructor
     *
     * Initializes the Escaper instance.
     */
    public function __construct() {
        $this->escaper = new Escaper('utf-8');
    }

    /**
     * Sanitize Input
     *
     * Escapes the user input to prevent XSS attacks.
     *
     * @param string $input The user input to sanitize.
     * @return string The sanitized input.
     */
    public function sanitizeInput($input) {
        try {
            // Use the Escaper component to sanitize the input
            return $this->escaper->escapeHtml($input);
        } catch (Exception $e) {
            // Handle any exceptions that may occur during sanitization
            error_log('Error sanitizing input: ' . $e->getMessage());
            return '';
        }
    }
}

// Example usage
try {
    $xssProtection = new XssProtection();
    $userInput = '<script>alert(1)</script>';
    $sanitizedInput = $xssProtection->sanitizeInput($userInput);
    echo "Sanitized Input: " . $sanitizedInput;
} catch (Exception $e) {
    // Handle any exceptions that occur during the example usage
    error_log('Error in example usage: ' . $e->getMessage());
}
