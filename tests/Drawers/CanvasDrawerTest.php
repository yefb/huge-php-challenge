<?php

use Challenge\Drawers\CanvasDrawer;

class CanvasDrawerTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->drawer = new CanvasDrawer();

        parent::setUp();
    }

    public function testCreateCanvasWithWidthAndHeight()
    {
        $this->drawer->setWidth(10);
        $this->drawer->setHeight(5);

        $canvas = $this->drawer->createCanvas();

        $expected = explode(" ", "- - - - - - - - - - - -");
        $this->assertEquals($expected, $canvas[0]);
        $this->assertEquals($expected, $canvas[6]);
        $this->assertEquals(" ", $canvas[2][2]);
        $this->assertEquals("|", $canvas[2][11]);
        $this->assertEquals(12, count($canvas[0]));
        $this->assertEquals(7, count($canvas));
    }

    public function testGenerateDrawing()
    {
        $this->drawer->setWidth(10);
        $this->drawer->setHeight(5);

        $canvas1 = $this->drawer->generateDrawing();
        $canvas2 = $this->drawer->createCanvas();

        $this->assertEquals($canvas1, $canvas2);
    }
} 
