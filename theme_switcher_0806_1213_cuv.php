<?php
// 代码生成时间: 2025-08-06 12:13:33
class ThemeSwitcher {
    /**
     * @var string The current theme.
     */
    private $currentTheme;

    /**
     * @var array Available themes.
     */
    private $themes;

    /**
     * Constructor for ThemeSwitcher.
     *
     * @param array $themes List of available themes.
     */
    public function __construct($themes) {
        $this->themes = $themes;
        $this->setCurrentTheme($this->getFirstTheme());
    }

    /**
     * Set the current theme.
     *
     * @param string $themeName The name of the theme to switch to.
     * @throws InvalidArgumentException If the theme is not available.
     */
    public function setCurrentTheme($themeName) {
        if (!in_array($themeName, $this->themes)) {
            throw new InvalidArgumentException("Theme '{$themeName}' is not available.");
        }
        $this->currentTheme = $themeName;
    }

    /**
     * Get the current theme.
     *
     * @return string The name of the current theme.
     */
    public function getCurrentTheme() {
        return $this->currentTheme;
    }

    /**
     * Get the first available theme.
     *
     * @return string The name of the first theme in the list.
     */
    private function getFirstTheme() {
        return array_values($this->themes)[0];
    }

    /**
     * Switch to a different theme.
     *
     * @param string $themeName The name of the theme to switch to.
     * @return bool True if the theme was switched successfully, false otherwise.
     */
    public function switchTheme($themeName) {
        try {
            $this->setCurrentTheme($themeName);
            return true;
        } catch (InvalidArgumentException $e) {
            // Handle the error, e.g., log it, and return false.
            return false;
        }
    }
}

// Usage example:
try {
    // Define available themes.
    $themes = ['light', 'dark', 'blue'];
    // Create a ThemeSwitcher instance.
    $themeSwitcher = new ThemeSwitcher($themes);
    // Switch to a different theme.
    if ($themeSwitcher->switchTheme('dark')) {
        echo "Theme switched to '{$themeSwitcher->getCurrentTheme()}' successfully.
";
    } else {
        echo "Failed to switch theme.
";
    }
} catch (Exception $e) {
    // Handle any exceptions that may occur.
    echo "An error occurred: " . $e->getMessage() . "
";
}
?>