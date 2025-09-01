<?php
// 代码生成时间: 2025-09-02 05:36:20
// bulk_file_rename.php
// 批量文件重命名工具

class BulkFileRename {

    protected $sourceDirectory;
    protected $targetDirectory;
    protected $newNamePattern;
    protected $fileExtension;
    protected $currentIndex = 0;

    // 构造函数
    public function __construct($sourceDirectory, $targetDirectory, $newNamePattern, $fileExtension) {
        $this->sourceDirectory = $sourceDirectory;
        $this->targetDirectory = $targetDirectory;
        $this->newNamePattern = $newNamePattern;
        $this->fileExtension = $fileExtension;
    }

    // 执行批量重命名
    public function renameFiles() {
        if (!file_exists($this->sourceDirectory)) {
            throw new Exception("Source directory does not exist.");
        }

        if (!is_dir($this->sourceDirectory)) {
            throw new Exception("Source is not a directory.");
        }

        if (!file_exists($this->targetDirectory)) {
            mkdir($this->targetDirectory, 0777, true);
        }

        $files = scandir($this->sourceDirectory);
        foreach ($files as $file) {
            if ($file !== '.' && $file !== '..') {
                $this->renameFile($file);
            }
        }
    }

    // 重命名单个文件
    private function renameFile($filename) {
        $newName = sprintf($this->newNamePattern, $this->currentIndex) . '.' . $this->fileExtension;
        $sourcePath = $this->sourceDirectory . DIRECTORY_SEPARATOR . $filename;
        $targetPath = $this->targetDirectory . DIRECTORY_SEPARATOR . $newName;

        if (!@rename($sourcePath, $targetPath)) {
            throw new Exception("Failed to rename file: $filename");
        }

        $this->currentIndex++;
    }
}

// 使用示例
try {
    // 假设我们有一个名为'images'的目录，其中包含一些.jpg图片
    $sourceDir = 'images/';
    $targetDir = 'renamed_images/';
    $newNamePattern = 'renamed_%03d'; // 重命名模式，如：renamed_001.jpg
    $fileExtension = 'jpg';

    // 创建BulkFileRename实例并执行重命名
    $renamer = new BulkFileRename($sourceDir, $targetDir, $newNamePattern, $fileExtension);
    $renamer->renameFiles();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
