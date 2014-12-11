<?php
/*
* This file is part of Shelly.
*
* (c) Bogdan Andritoiu <bogdan@andritoiu.ro>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

namespace ABogdan\Shelly;

use ABogdan\Shelly\Command\Command;
use ABogdan\Shelly\Command\CompositeCommand;

/**
 * Class Builder
 * @package ABogdan\Shelly
 */
class Builder
{
    /**
     * @param Command $command
     * @param bool $xargs
     * @return string
     */
    public function build(Command $command, $xargs = false)
    {
        if ($command instanceof CompositeCommand) {
            return $this->buildComposite($command);
        }
        return sprintf(
            '%s%s %s',
            ($xargs ? 'xargs ' : ''),
            $command->getCommand(),
            $command->getArguments(true)
        );
    }

    /**
     * @param CompositeCommand $command
     * @return string
     */
    protected function buildComposite(CompositeCommand $command)
    {
        $builtCommands = array();
        $previousCommand = null;
        foreach ($command->getCommands()->getIterator() as $cmd) {
            $builtCommands[] = $this->build($cmd, $previousCommand ? $previousCommand->xargs() : false);
            $previousCommand = $cmd;
        }
        return join(' | ', $builtCommands);
    }
} 