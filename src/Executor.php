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