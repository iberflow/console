<?php

namespace Iber\Console\Tests;

use Iber\Console\UI\Cursor;

class SomethingTest extends \PHPUnit_Framework_TestCase
{
    public function testPositionChange()
    {
        $steps = mt_rand(1, 10);

        $cursor = new Cursor();

        $cursor->moveDown($steps);
        $this->assertEquals(1, $cursor->getPosition());

        $cursor->moveUp($steps);
        $this->assertEquals(0, $cursor->getPosition());

        $cursor->moveUp($steps);
        $this->assertEquals($steps - 1, $cursor->getPosition());
    }
}