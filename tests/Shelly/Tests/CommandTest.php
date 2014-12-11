<?php

namespace PhpCollection\Tests;

use ABogdan\Shelly\Builder;
use ABogdan\Shelly\Command\SimpleCommand;
use ABogdan\Shelly\Executor;
use PhpCollection\Map;

class CommandTest extends \PHPUnit_Framework_TestCase
{
    public function testSimpleCommand()
    {
        $command = new SimpleCommand('cat', [__FILE__]);
        $executor = new Executor(new Builder());
        $this->assertEquals(file_get_contents(__FILE__), $executor->execute($command));
    }

    public function testXargsCommand()
    {
        $seq = new \PhpCollection\Sequence();
        $builder = new \ABogdan\Shelly\Builder();
        $xec = new Executor($builder);
        $find = new SimpleCommand('find', ['./tests/', '-name', 'Command*'], true);
        $cat = new SimpleCommand('cat');
        $grep = new SimpleCommand('grep', ['-r', PHP_EOL]);
        $seq->add($find);
        $seq->add($cat);
        $seq->add($grep);
        $complex = new \ABogdan\Shelly\Command\CompositeCommand($seq);
        $o = $xec->execute($complex);
        $this->assertEquals(file_get_contents(__FILE__), $o);
    }
}