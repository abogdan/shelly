<?php
/*
* This file is part of Shelly.
*
* (c) Bogdan Andritoiu <bogdan@andritoiu.ro>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace ABogdan\Shelly\Command;

/**
 * Class SimpleCommand
 * @package ABogdan\Shelly\Command
 */
class SimpleCommand extends Command
{
    protected $command;
    protected $args;
    protected $needsXargs;

    /**
     * @param $command
     * @param array $args
     * @param bool $needsXargs
     */
    public function __construct($command, $args = [], $needsXargs = false)
    {
        $this->command = $this->detectBinary($command);
        $this->args = $args;
        $this->needsXargs = $needsXargs;
    }

    /**
     * @return string
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * @param bool $asString
     * @return array|string
     */
    public function getArguments($asString = false)
    {
        return $asString ? $this->stringifyArguments($this->args) : $this->args;
    }

    /**
     * @return bool
     */
    public function xargs()
    {
        return (bool) $this->needsXargs;
    }
} 