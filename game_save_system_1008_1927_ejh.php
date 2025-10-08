<?php
// 代码生成时间: 2025-10-08 19:27:46
class GameSaveSystem {

    /**
     * Path to the directory where game saves are stored.
     *
     * @var string
     */
    private $saveDirectory;

    /**
     * Constructor
     *
     * @param string $saveDirectory Path to the directory where game saves are stored.
     */
    public function __construct($saveDirectory) {
        $this->saveDirectory = $saveDirectory;
        if (!file_exists($this->saveDirectory)) {
            mkdir($this->saveDirectory, 0777, true);
        }
    }

    /**
     * Save the game state to a file.
     *
     * @param string $gameId Unique identifier for the game.
     * @param array $state Game state data to save.
     * @return bool True on success, false on failure.
     */
    public function saveGame($gameId, $state) {
        // Ensure the game state is an array
        if (!is_array($state)) {
            throw new InvalidArgumentException('Game state must be an array.');
        }

        // Serialize the game state data
        $serializedState = serialize($state);

        // Create the file path
        $filePath = $this->saveDirectory . '/' . $gameId . '.save';

        // Save the serialized game state to the file
        if (file_put_contents($filePath, $serializedState) === false) {
            // Handle error
            throw new RuntimeException('Failed to save game state.');
        }

        return true;
    }

    /**
     * Load the game state from a file.
     *
     * @param string $gameId Unique identifier for the game.
     * @return array|null The loaded game state on success, null on failure.
     */
    public function loadGame($gameId) {
        // Create the file path
        $filePath = $this->saveDirectory . '/' . $gameId . '.save';

        // Check if the save file exists
        if (!file_exists($filePath)) {
            // Handle error
            throw new RuntimeException('Game save file not found.');
        }

        // Read the serialized game state from the file
        $serializedState = file_get_contents($filePath);

        // Unserialize the game state data
        return unserialize($serializedState);
    }

}

// Example usage:
try {
    $saveSystem = new GameSaveSystem('/path/to/saves');
    $gameId = 'unique_game_id';
    $gameState = [
        'player' => [
            'name' => 'Player1',
            'level' => 5
        ],
        'items' => ['sword', 'shield']
    ];

    // Save the game state
    $saveSystem->saveGame($gameId, $gameState);

    // Load the game state
    $loadedState = $saveSystem->loadGame($gameId);
    print_r($loadedState);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
