<?php

namespace Iber\Console\Tests;

use Iber\Console\Process\Signals;

class SignalTest extends \PHPUnit_Framework_TestCase
{
    public function testSignalExecution()
    {
        $signals = new Signals();

        $signals->append(1, function() {
            return 'signal code';
        });

        $this->assertEquals('signal code', $signals->executeListener(1, false));
    }
}