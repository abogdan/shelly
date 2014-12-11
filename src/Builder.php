<?php

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