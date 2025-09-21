<?php
// 代码生成时间: 2025-09-21 08:02:32
require_once 'Zend/Loader/Autoloader.php';
Zend_Loader_Autoloader::getInstance();

/**
 * UserPermissionManager
 * 
 * This class manages user permissions.
 */
class UserPermissionManager {
    /**
     * @var array An array to store user permissions.
     */
    protected $permissions;

    public function __construct() {
        // Initialize permissions array
        $this->permissions = array();
    }

    /**
     * Add a permission to the system for a user.
     * 
     * @param string $userId The ID of the user.
     * @param string $permission The permission to add.
     * @return bool Returns true on success, false on failure.
     */
    public function addPermission($userId, $permission) {
        try {
            if (!isset($this->permissions[$userId])) {
                $this->permissions[$userId] = array();
            }
            if (!in_array($permission, $this->permissions[$userId])) {
                $this->permissions[$userId][] = $permission;
                return true;
            } else {
                // Permission already exists
                return false;
            }
        } catch (Exception $e) {
            // Handle exceptions
            error_log($e->getMessage());
            return false;
        }
    }

    /**
     * Remove a permission from the system for a user.
     * 
     * @param string $userId The ID of the user.
     * @param string $permission The permission to remove.
     * @return bool Returns true on success, false on failure.
     */
    public function removePermission($userId, $permission) {
        try {
            if (isset($this->permissions[$userId]) && 
                ($key = array_search($permission, $this->permissions[$userId])) !== false) {
                unset($this->permissions[$userId][$key]);
                return true;
            } else {
                // Permission not found or user doesn't exist
                return false;
            }
        } catch (Exception $e) {
            // Handle exceptions
            error_log($e->getMessage());
            return false;
        }
    }

    /**
     * Check if a user has a specific permission.
     * 
     * @param string $userId The ID of the user.
     * @param string $permission The permission to check.
     * @return bool Returns true if the user has the permission, false otherwise.
     */
    public function hasPermission($userId, $permission) {
        return isset($this->permissions[$userId]) && in_array($permission, $this->permissions[$userId]);
    }

    /**
     * Get all permissions for a user.
     * 
     * @param string $userId The ID of the user.
     * @return array Returns an array of permissions for the user.
     */
    public function getPermissions($userId) {
        return isset($this->permissions[$userId]) ? $this->permissions[$userId] : array();
    }
}
