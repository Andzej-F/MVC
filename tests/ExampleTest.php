<?php

use \PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function testAddingTwoPlusTwoResultsInFour()
    {
        echo get_class($this);

        $this->assertEquals(5, 2 + 2);
    }
}
