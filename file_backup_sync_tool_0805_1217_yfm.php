<?php
// 代码生成时间: 2025-08-05 12:17:26
class FileBackupSyncTool {

    /**
     * @var string The source directory where files will be read from.
     */
    private $sourceDir;

    /**
     * @var string The destination directory where files will be copied to.
     */
    private $destDir;

    /**
     * Constructor
     *
     * @param string $sourceDir The source directory.
     * @param string $destDir The destination directory.
     */
    public function __construct($sourceDir, $destDir) {
        $this->sourceDir = $sourceDir;
        $this->destDir = $destDir;
    }

    /**
     * Backup and sync files from source to destination directory.
     *
     * @return bool True on success, false on failure.
     */
    public function backupAndSync() {
        try {
            // Check if source and destination directories exist
            if (!is_dir($this->sourceDir) || !is_dir($this->destDir)) {
                throw new Exception('Source or destination directory does not exist.');
            }

            // Get the list of files in the source directory
            $sourceFiles = scandir($this->sourceDir);

            // Iterate through the files and backup/sync them
            foreach ($sourceFiles as $file) {
                if ($file !== '.' && $file !== '..') {
                    $sourceFilePath = $this->sourceDir . '/' . $file;
                    $destFilePath = $this->destDir . '/' . $file;

                    // Check if the file is a directory
                    if (is_dir($sourceFilePath)) {
                        // Recursively backup/sync subdirectories
                        $this->backupAndSyncSubdirectory($sourceFilePath, $destFilePath);
                    } else {
                        // Copy the file to the destination directory
                        copy($sourceFilePath, $destFilePath);
                    }
                }
            }

            // Remove any files in the destination directory that are not in the source directory
            $this->removeOrphanedFiles($this->destDir);

            return true;
        } catch (Exception $e) {
            // Handle any exceptions that occur during the backup and sync process
            error_log($e->getMessage());
            return false;
        }
    }

    /**
     * Recursively backup and sync subdirectories.
     *
     * @param string $sourceSubDir The source subdirectory.
     * @param string $destSubDir The destination subdirectory.
     */
    private function backupAndSyncSubdirectory($sourceSubDir, $destSubDir) {
        if (!is_dir($destSubDir)) {
            mkdir($destSubDir, 0777, true);
        }

        $subFiles = scandir($sourceSubDir);
        foreach ($subFiles as $file) {
            if ($file !== '.' && $file !== '..') {
                $sourceSubFilePath = $sourceSubDir . '/' . $file;
                $destSubFilePath = $destSubDir . '/' . $file;

                if (is_dir($sourceSubFilePath)) {
                    $this->backupAndSyncSubdirectory($sourceSubFilePath, $destSubFilePath);
                } else {
                    copy($sourceSubFilePath, $destSubFilePath);
                }
            }
        }
    }

    /**
     * Remove any files in the destination directory that are not in the source directory.
     *
     * @param string $dir The directory to clean.
     */
    private function removeOrphanedFiles($dir) {
        $files = scandir($dir);
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                $filePath = $dir . '/' . $file;
                if (!file_exists($filePath)) {
                    @unlink($filePath);
                }
            }
        }
    }
}

// Usage example
try {
    $sourceDir = '/path/to/source';
    $destDir = '/path/to/destination';
    $backupSyncTool = new FileBackupSyncTool($sourceDir, $destDir);
    if ($backupSyncTool->backupAndSync()) {
        echo 'Backup and sync completed successfully.';
    } else {
        echo 'Backup and sync failed.';
    }
} catch (Exception $e) {
    error_log($e->getMessage());
}
