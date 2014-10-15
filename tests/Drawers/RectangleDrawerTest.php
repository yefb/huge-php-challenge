<?php

use Challenge\Drawers\CanvasDrawer;

class RectangleDrawerTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->canvasDrawer = new CanvasDrawer();

        $this->mock = $this->getMock('Challenge\Drawers\RectangleDrawer',
            [
                'validateCoords',
            ]);

        $this->createCanvas();
    }

    public function testDrawARectangle()
    {
        $this->createCanvas();

        $c = new StdClass;
        $c->startingX = 2;
        $c->startingY = 2;
        $c->endingX = 4;
        $c->endingY = 4;

        $this->mock->setCoords($c);
        $canvas = $this->mock->generateDrawing();

        $this->assertEquals(" ", $canvas[2][1]);
        $this->assertEquals("X", $canvas[2][2]);
        $this->assertEquals("X", $canvas[2][4]);
        $this->assertEquals("X", $canvas[4][2]);
        $this->assertEquals("X", $canvas[4][4]);
        $this->assertEquals(" ", $canvas[5][5]);
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
