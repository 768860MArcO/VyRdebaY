<?php
// 代码生成时间: 2025-08-14 05:15:58
class ImageResizer {
    private $sourceDir;
    private $targetDir;
    private $width;
    private $height;

    /**
     * Constructor
     *
     * @param string $sourceDir The directory path containing the source images
     * @param string $targetDir The directory path to store the resized images
     * @param int $width The desired width for the resized images
     * @param int $height The desired height for the resized images
     */
    public function __construct($sourceDir, $targetDir, $width, $height) {
        $this->sourceDir = $sourceDir;
        $this->targetDir = $targetDir;
        $this->width = $width;
        $this->height = $height;
    }

    /**
     * Resize images in the source directory
     *
     * @return void
     */
    public function resizeImages() {
        if (!is_dir($this->sourceDir) || !is_dir($this->targetDir)) {
            throw new Exception('Source or target directory does not exist.');
        }

        $images = glob($this->sourceDir . '/*.{jpg,jpeg,png,gif}', GLOB_BRACE);

        foreach ($images as $image) {
            $this->resizeImage($image);
        }
    }

    /**
     * Resize a single image
     *
     * @param string $imagePath The path to the image to be resized
     * @return void
     */
    private function resizeImage($imagePath) {
        $info = getimagesize($imagePath);
        $mime = $info['mime'];

        switch ($mime) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($imagePath);
                break;
            case 'image/png':
                $image = imagecreatefrompng($imagePath);
                break;
            case 'image/gif':
                $image = imagecreatefromgif($imagePath);
                break;
            default:
                throw new Exception('Unsupported image format.');
        }

        $resizedImage = imagecreatetruecolor($this->width, $this->height);
        imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $this->width, $this->height, $info[0], $info[1]);

        $targetPath = str_replace($this->sourceDir, $this->targetDir, $imagePath);

        switch ($mime) {
            case 'image/jpeg':
                imagejpeg($resizedImage, $targetPath);
                break;
            case 'image/png':
                imagepng($resizedImage, $targetPath);
                break;
            case 'image/gif':
                imagegif($resizedImage, $targetPath);
                break;
        }

        imagedestroy($image);
        imagedestroy($resizedImage);
    }
}

// Example usage:
try {
    $resizer = new ImageResizer('/path/to/source', '/path/to/target', 100, 100);
    $resizer->resizeImages();
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
