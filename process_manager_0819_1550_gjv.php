<?php
// 代码生成时间: 2025-08-19 15:50:56
class ProcessManager {

    /**
     * Lists all running processes.
     *
     * @return array An array of process information.
     */
    public function listProcesses() {
        $output = [];
        exec('ps -e', $output);
        return $output;
    }

    /**
     * Starts a new process.
     *
     * @param string $command The command to execute.
     * @return string The process ID or an error message.
     */
    public function startProcess($command) {
        if (empty($command)) {
            return 'Error: Command cannot be empty.';
        }

        $process = shell_exec($command . ' > /dev/null 2>&1 & echo $!');
        return $process ? $process : 'Error: Unable to start process.';
    }

    /**
     * Stops a running process by its ID.
     *
     * @param string $pid The process ID to stop.
     * @return bool True on success, false on failure.
     */
    public function stopProcess($pid) {
        if (!ctype_digit($pid)) {
            return false;
        }

        exec('kill ' . $pid);
        return true;
    }

}

// Example usage:
// $processManager = new ProcessManager();
// $processes = $processManager->listProcesses();
// print_r($processes);
// $pid = $processManager->startProcess('sleep 60');
// echo 'New process ID: ' . $pid . "
";
// $processManager->stopProcess($pid);
