<?php

namespace ABogdan\Shelly;

use ABogdan\Shelly\Command\Command;
use Symfony\Component\Process\Process;

/**
 * Class Executor
 * @package ABogdan\Shelly
 */
class Executor
{
    /**
     * @var Builder
     */
    protected $builder;

    /**
     * @param Builder $builder
     */
    public function __construct(Builder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * @param Command $cmd
     * @return string
     * @throws \RuntimeException
     */
    public function execute(Command $cmd)
    {
        $process = new Process($this->builder->build($cmd));
        $process->run();
        if (!$process->isSuccessful()) {
            throw new \RuntimeException($process->getErrorOutput());
        }
        return rtrim($process->getOutput(), PHP_EOL);
    }
}