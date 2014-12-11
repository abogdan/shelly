<?php

namespace ABogdan\Shelly\Command;

use Symfony\Component\Process\Process;

/**
 * Class Command
 * @package ABogdan\Shelly\Command
 */
abstract class Command
{
    /**
     * @return bool
     */
    public function xargs()
    {
        return false;
    }

    /**
     * @param $executable
     * @return string
     */
    protected function detectBinary($executable)
    {
        if (false !== strpos($executable, '/')) {
            return $executable;
        }
        $process = new Process(sprintf('which %s', $executable));
        $process->run();
        if (!$process->isSuccessful()) {
            //throw new \RuntimeException($process->getErrorOutput());
            return $executable;
        }
        return trim($process->getOutput());
    }

    /**
     * @param array $args
     * @return string
     */
    protected function stringifyArguments(array $args = [])
    {
        $result = '';
        foreach ($args as $key => $arg) {
            if ($arg) {
                if (is_numeric($key)) {
                    $result .= sprintf(' %s', escapeshellarg($arg));
                } else {
                    $result .= sprintf(' %s %s', $key, escapeshellarg($arg));
                }
            }
        }
        return $result;
    }
} 