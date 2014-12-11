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

use PhpCollection\Sequence;

/**
 * Class CompositeCommand
 * @package ABogdan\Shelly\Command
 */
class CompositeCommand extends Command
{
    /**
     * @var \PhpCollection\Sequence
     */
    protected $commands;

    /**
     * @param Sequence $commands
     */
    public function __construct(Sequence $commands)
    {
        $this->commands = $commands;
    }

    /**
     * @return Sequence
     */
    public function getCommands()
    {
        return $this->commands;
    }
} 