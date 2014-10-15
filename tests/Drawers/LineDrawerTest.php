<?php

use Challenge\Drawers\CanvasDrawer;

class LineDrawerTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->canvasDrawer = new CanvasDrawer();

        $this->mock = $this->getMock('Challenge\Drawers\LineDrawer',
            [
                'validateCoords',
            ]);

        $this->createCanvas();
    }

    public function testDrawAnHorizontalLine()
    {
        $c = new StdClass;
        $c->startingX = 2;
        $c->startingY = 2;
        $c->endingX = 8;
        $c->endingY = 2;

        $this->mock->setCoords($c);
        $canvas = $this->mock->generateDrawing();

        $this->assertEquals(" ", $canvas[2][1]);
        $this->assertEquals("X", $canvas[2][2]);
        $this->assertEquals("X", $canvas[2][7]);
        $this->assertEquals("X", $canvas[2][8]);
    }

    public function testDrawAVerticalLine()
    {
        $c = new StdClass;
        $c->startingX = 2;
        $c->startingY = 2;
        $c->endingX = 2;
        $c->endingY = 8;

        $this->mock->setCoords($c);
        $canvas = $this->mock->generateDrawing();

        $this->assertEquals(" ", $canvas[1][2]);
        $this->assertEquals("X", $canvas[2][2]);
        $this->assertEquals("X", $canvas[7][2]);
        $this->assertEquals("X", $canvas[8][2]);
    }

    private function createCanvas()
    {
        $this->canvasDrawer->setWidth(10);
        $this->canvasDrawer->setHeight(5);

        $canvas = $this->canvasDrawer->createCanvas();
        $this->canvasDrawer->saveCurrentDrawing($canvas);

        return $canvas;
    }
}
